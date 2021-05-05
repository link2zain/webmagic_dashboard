'use strict';

/***********************************************************************************************************************
 * Path and file naming settings
 **********************************************************************************************************************/
require('events').EventEmitter.prototype._maxListeners = 400;


const main_project_path = 'public';

const src_dir = './';

const scss_main_file_name = 'style.scss';
const css_main_file_name = 'style.css';
const sprite_img_file_name = '../img/sprites/sprite.png';
const sprite_scss_file_name = '_sprite.scss';
// const zip_file_name = 'build.zip';
const settings = {};


Object.defineProperty(settings, 'build_dir', {
    get : function() {
        // console.log(process.env.NODE_ENV === 'prod' ? '../../../../public/' : '../../../../../../' + main_project_path + '/webmagic/dashboard/');
        // return process.env.NODE_ENV === 'prod' ? '../../../../public/' : '../../../../../../' + main_project_path + '/webmagic/dashboard/';

        console.log(process.env.NODE_ENV === 'prod' ? '../../../public/' : '../../../../../app/' + main_project_path + '/webmagic/dashboard/');
        return process.env.NODE_ENV === 'prod' ? '../../../public/' : '../../../../../app/' + main_project_path + '/webmagic/dashboard/';
    }
});



const path = {
    build: {
        css: settings.build_dir + '/css/',
        js: settings.build_dir + '/js/',
        img: settings.build_dir + '/img/',
        fonts: settings.build_dir + '/fonts/',
        sprite_scss: src_dir + '/sass/4_common',
        zip: settings.build_dir + '/',
    },
    src: {
        css: src_dir + 'sass/' + scss_main_file_name,
        img: src_dir + 'img/**/*.*',
        fonts: src_dir + 'fonts/*.ttf',
        sprites: src_dir + 'img/sprites/*.*',
        js: [src_dir + 'js/libs.js', src_dir + 'js/script.js'],
        zip: [settings.build_dir + '/**', '!' + settings.build_dir + '/_gulp-builder/node_modules/**', '!' + settings.build_dir],
    },
    watch: {
        css: src_dir + '/sass/**/*.*',
        img: src_dir + '/img/**/*.*',
        fonts: src_dir + '/fonts/**/*.*',
        sprite: src_dir + '/img/sprites/*.*'
    },
    clean: settings.build_dir + '/'
};

/***********************************************************************************************************************
 * Plugins
 **********************************************************************************************************************/

const gulp = require('gulp');
const gulpIf = require('gulp-if');
const debug = require('gulp-debug');
const { series, parallel } = require('gulp');
const webpack = require('webpack-stream');
const plugins = {
    'sass': require('gulp-sass'),
    'prefixer': require('gulp-autoprefixer'),
    'rename': require('gulp-rename'),
    'cssmin': require('gulp-clean-css'),
    'sourcemaps': require('gulp-sourcemaps'),
    'spritesmith': require('gulp.spritesmith'),
    'buffer': require('vinyl-buffer'),
    'imagemin': require('gulp-imagemin'),
    'mergeStream': require('merge-stream'),
    'ttf2woff': require('gulp-ttf2woff'),
    'ttf2eot': require('gulp-ttf2eot'),
    'plumber': require('gulp-plumber'),
    'pngquant': require('imagemin-pngquant'),
    'watch': require('gulp-watch'),
    'uglify': require('gulp-uglify'),
    'rimraf': require('rimraf'),
    'zip': require('gulp-zip'),

    'importCss': require('gulp-import-css'),
};


/***********************************************************************************************************************
 * Tasks registration
 **********************************************************************************************************************/

/***********************************************************************************************************************
 * Task: Sprite
 ***********************************************************************************************************************
 *
 * Concatenates images in one sprite image and generate .scss file sprite mixins
 *
 **********************************************************************************************************************/

gulp.task('sprite', function() {
    return gulp.src(path.src.sprites)
        .pipe(plugins.spritesmith({
            imgName: sprite_img_file_name, // Image file
            cssName: sprite_scss_file_name, // CSS file
            cssVarMap: function(sprite) {
                sprite.name = 's-' + sprite.name;
            }
        }))
        .pipe(gulpIf('*.png', gulp.dest(path.build.img)))
        .pipe(gulpIf('*.scss', gulp.dest(path.build.sprite_scss)));
});

/***********************************************************************************************************************
 * Task: CSS
 ***********************************************************************************************************************
 *
 * Compiles .scss files to css. Adds vendor prefixes and minimizes
 *
 **********************************************************************************************************************/

gulp.task('css:build', function() {
    return gulp.src(path.src.css)
        .pipe(plugins.sass().on('error', plugins.sass.logError))
        .pipe(plugins.prefixer())
        .pipe(plugins.rename('dist.' + css_main_file_name))
        .pipe(gulp.dest(path.build.css))
        .pipe(plugins.cssmin())
        .pipe(plugins.rename(css_main_file_name))
        .pipe(gulp.dest(path.build.css));
});


gulp.task('css:dev', function() {
    return gulp.src(path.src.css)
        .pipe(plugins.sourcemaps.init())
        .pipe(plugins.sass().on('error', plugins.sass.logError))
        .pipe(plugins.prefixer())
        .pipe(plugins.cssmin())
        .pipe(plugins.rename(css_main_file_name))
        .pipe(plugins.sourcemaps.write())
        .pipe(gulp.dest(path.build.css));
});

/***********************************************************************************************************************
 * Task: Webpack
 ***********************************************************************************************************************
 *
 * Run webpack
 *
 **********************************************************************************************************************/

gulp.task('js:build', function() {
    return gulp.src(path.src.js)
        .pipe(webpack( require('./webpack.config.js') ))
        .pipe(gulp.dest(path.build.js));
});

gulp.task('js', function() {
    return gulp.src(path.src.js)
        .pipe(webpack( require('./webpack.config.js') ))
        .pipe(gulp.dest(path.build.js));
});

/***********************************************************************************************************************
 * Task: Test by karma
 ***********************************************************************************************************************
 *
 * Run test files
 *
 **********************************************************************************************************************/
/**
 * Run test once and exit
 */
// gulp.task('test', function (done) {
//     new Server({
//         configFile: __dirname + '/karma.config.js',
//         singleRun: true
//     }, done).start();
// });


/***********************************************************************************************************************
 * Task: Img
 ***********************************************************************************************************************
 *
 * Compress .png and .jpg files
 *
 **********************************************************************************************************************/

gulp.task('img:build', function() {
    return gulp.src([path.src.img, '!' + path.src.sprites])
        .pipe(plugins.plumber())
        .pipe(plugins.imagemin(
            {
                interlaced: true,
                progressive: true,
                optimizationLevel: 3,
                svgoPlugins: [{
                    removeViewBox: false
                }],
                use: [plugins.pngquant()]
            }))
        .pipe(gulp.dest(path.build.img));
});
//
// gulp.task('img:dev', function() {
//     gulp.src([path.src.img, '!' + path.src.sprites])
//         .pipe(gulp.dest(path.build.img))
// });

/***********************************************************************************************************************
 * Task: Fonts
 ***********************************************************************************************************************
 *
 * Generate .eot and .woff files frome one .ttf file.
 * Reacts on .ttf only
 *
 **********************************************************************************************************************/

gulp.task('fonts', function() {
    return plugins.mergeStream(
        gulp.src(path.src.fonts)
            .pipe(gulp.dest(path.build.fonts))
            .pipe(plugins.ttf2eot())
            .pipe(gulp.dest(path.build.fonts)),
        gulp.src(path.src.fonts)
            .pipe(plugins.ttf2woff())
            .pipe(gulp.dest(path.build.fonts))
    )
});

/***********************************************************************************************************************
 * Task: Jshint
 ***********************************************************************************************************************
 *
 * РЎhecks js code for correctness
 *
 *
 **********************************************************************************************************************/


// gulp.task('lint', function() {
//   return gulp.src(path.src.lint)
//     .pipe(plugins.jshint())
//     .pipe(plugins.jshint.reporter(plugins.stylish));
// });



/***********************************************************************************************************************
 * Task: ZIP
 ***********************************************************************************************************************
 *
 * Compress build path in .zip file.
 * Use for deploying preparing
 *
 **********************************************************************************************************************/

// gulp.task('zip', function() {
//     return gulp.src(path.src.zip)
//         .pipe(plugins.plumber())
//         .pipe(plugins.zip(zip_file_name))
//         .pipe(gulp.dest(path.build.zip));
// });

/***********************************************************************************************************************
 * Task: Clean
 ***********************************************************************************************************************
 *
 * Cleans build directory
 *
 **********************************************************************************************************************/
//
// gulp.task('clean', function(cb) {
//     plugins.rimraf(path.clean, cb);
// });

/***********************************************************************************************************************
 * Task: Build
 ***********************************************************************************************************************
 *
 * Run all task in build mode. Prepare all for production
 *
 **********************************************************************************************************************/

gulp.task('build', series(
    'sprite', parallel(
        'css:build',
        'fonts',
        'img:build',
        'js:build'
    )
));



/***********************************************************************************************************************
 * Task: Build
 ***********************************************************************************************************************
 *
 * Run all task in development mode. Quick use for developing process
 *
 **********************************************************************************************************************/

gulp.task('dev', series(
    'sprite', parallel(
    'js',
    'css:dev',
    'fonts'
    )
));

/***********************************************************************************************************************
 * Task: Watch
 ***********************************************************************************************************************
 *
 * Watch all files and start needed tasks when changes happen
 *
 **********************************************************************************************************************/
gulp.task('watch', parallel(
    'js',
    watchGulpFile
));
function watchGulpFile() {
    plugins.watch([path.watch.css], parallel('css:dev'));
    plugins.watch([path.watch.sprite], parallel('sprite'));
    plugins.watch([path.watch.fonts], parallel('fonts'));
}




/***********************************************************************************************************************
 * Task: Watch
 ***********************************************************************************************************************
 *
 * Run all tasks in dev mode and than run watch task
 *
 **********************************************************************************************************************/

gulp.task('default',  series('dev', watchGulpFile));

# Dashboard builder module
This module may be used for build dashboard based on any stiles. In current realization we will use AdmiLTE template but maybe in future core functionality will move to separate project

## Description
The main idea of this module is to give the possibility to generate the dashboard pages from PHP with Laravel power. At the same time, to give the possibility to flexibly configure, expand and modify the generation process.

## Getting started
- [Quick start](docs/quick-start.md)
- [Installation](docs/installation.md)
- [Main menu](docs/main-menu.md)

## Pages fast building description
- [Basic Page](docs/pages/basic-page.md)
- [Login Page](docs/pages/login-page.md)
- [Table page](docs/pages/table-page.md)
- [Form page](docs/pages/form-page.md)

## Forms and form elements
- [Visual Editor](docs/elements/visual-editor.md) 

## Additional features
- [Select2 response converter](docs/additional-features/select2-response-converter.md) - convert array to Select2 format

### Dashboard

Dashboard it's just class which creating BasePage with settings and call method render.
But this class is singleton that's mean once you set up class then you will get the same class in any part of your app.
More about singleton for example here : http://dron.by/post/pattern-proektirovaniya-singleton-odinochka-na-php.html
Dashboard can get the same with BasePage.

```php
Route::get('dashboard', function () {
   return app(\Webmagic\Dashboard\Dashboard::class);
});
```

### Define logo
[Logo element description](docs/elements/logo-link-element.md)

### Work with main menu
[Main menu description](docs/elements/main-menu-element.md)


### Work with navbar menu
NavBar menu extends MainMenu so the functionality and ability the same as Main menu

## Front
Building setting up with gulp and webpack,  all commands you can run with gulp. In building setup two environments 'dev' and 'prod'

'dev' environment - run building front into root public directory
'prod' environment - run building front into module public directory

for set/change environment run in console command:
`set NODE_ENV=prod/dev` - for Windows
`export NODE_ENV=prod/dev` - for Linux

## Updating assets after module updated
For update assets after module updated you can use console command:

`php artisan dashboard::assets-update`

This command will removed your current assets and copied new assets for package. Destination path you can change with param --path. As default it is `public_path('webmagic/dashboard')`

## Using local version of dashboard inside other project
 Set volumes into your  **docker-compose.yml**
 ```
 volumes:
       ...
       -  "../packages:/srv/packages"
 ```     
 Add it to **composer.json** of your app
 ```
"autoload-dev": {
        "psr-4": {
            "Tests\\": "tests/",
            "Webmagic\\Dashboard\\":"/srv/packages/dashboard/"
        }
    },
```

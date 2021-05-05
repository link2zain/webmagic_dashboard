<?php

namespace Webmagic\Dashboard;

use GrahamCampbell\Markdown\MarkdownServiceProvider;
use Illuminate\Config\Repository;
use PackageVersions\Versions;
use View;
use Webmagic\Dashboard\Console\Commands\ComponentsMetaMethodsGenerate;
use Webmagic\Dashboard\Console\Commands\GenerateComponent;
use Webmagic\Dashboard\Console\Commands\UpdateAssetData;
use Webmagic\Dashboard\Elements\Menus\MainMenu\MainMenu;
use Webmagic\Dashboard\Elements\Menus\NavBarMenu\NavBarMenu;
use Webmagic\Dashboard\NotificationService\NotificationService;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;


class DashboardServiceProvider extends BaseServiceProvider
{
    /**
     * Path for config
     * @var string
     */
    protected $configPath = 'webmagic.dashboard.dashboard';

    /**
     * Boot
     */
    public function boot()
    {
        //Load Views
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'dashboard');

        $this->registerPublishes();

        $this->registerCommands();

        $this->loadTranslations();

        $this->prepareDashboardVersion();

        // Load presentation routs
        if (config('webmagic.dashboard.dashboard.presentation_mode')) {
            $this->loadRoutesFrom(__DIR__ . '/../routes/routes.php');
            $this->app->register(MarkdownServiceProvider::class);
        }

        // Load API routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/api.php');
    }

    /**
     * Prepare variable with current dashboard package version
     */
    protected function prepareDashboardVersion()
    {
        $version = Versions::getVersion('webmagic/dashboard');
        $version = preg_replace('/\@.*/', '', $version);

        View::share('webmagicDashboardVersion', $version);
    }

    /**
     * Register
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/dashboard.php',
            $this->configPath
        );

        $this->registerDashboardAndMenus();
    }

    /**
     * Register console commands
     */
    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                UpdateAssetData::class,
                ComponentsMetaMethodsGenerate::class,
                GenerateComponent::class
            ]);
        }
    }

    /**
     * Register all publishes
     */
    protected function registerPublishes()
    {
        $this->publishes([
            __DIR__ . '/../resources/views' => resource_path('views/vendor/webmagic/dashboard'),
            __DIR__ . '/../public' => public_path('webmagic/dashboard'),
            __DIR__ . '/../config' => config_path('webmagic/dashboard'),
            __DIR__ . '/../resources/lang' => resource_path('lang/vendor/webmagic/dashboard'),
        ], 'webmagic/dashboard::all');

        $this->publishes([
            __DIR__ . '/../public' => public_path('webmagic/dashboard'),
            __DIR__ . '/../config' => config_path('webmagic/dashboard'),
        ], 'webmagic/dashboard::min');
    }

    /**
     * Prepare dashboard
     */
    protected function registerDashboardAndMenus()
    {
        // Register Dashboard
        $this->app->singleton(Dashboard::class, Dashboard::class);

	    // Register Notification Service
	    $this->app->singleton(NotificationService::class, NotificationService::class);

	    // Prepare Main Menu
        $this->app->singleton(MainMenu::class, function () {
            $menuConfig = $this->prepareDashboardMenuConfig();

            return new MainMenu($menuConfig);
        });

        // Prepare Nav Bar Menu
        $this->app->singleton(NavBarMenu::class, function () {
            $menuConfig = config('webmagic.dashboard.dashboard.header_navigation');

            return new NavBarMenu($menuConfig);
        });
    }

    /**
     * Prepare config for main manu
     *
     * @return Repository|mixed
     */
    protected function prepareDashboardMenuConfig()
    {
        // Load main config
        $menuConfig = config('webmagic.dashboard.dashboard.menu');

        // Optional loading presentation menu config
        if (config('webmagic.dashboard.dashboard.presentation_mode')) {
            $presentMenuConf = require __DIR__ . '/../config/presentation-menu-config.php';
            $menuConfig = array_merge($menuConfig, $presentMenuConf);
        }

        return $menuConfig;
    }

    /**
     * Load dashboard translations
     */
    protected function loadTranslations()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'dashboard');
    }
}

<?php

namespace Webmagic\Dashboard\Console\Commands;

use Illuminate\Console\Command;

class GenerateComponent extends Command
{
    /** @var string */
    protected $stub = __DIR__ . '/stubs/component.stub';

    /** @var string Dashboard namespace for recognize dashboard elements generation */
    protected $dashboardNamespace = 'Webmagic\Dashboard';

    /** @var string  */
    protected $defaultViewString = 'dashboard::define_view';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dashboard:components-generate 
        {fullClassName : New element full class name with namespace}
        {--view=dashboard::define_view : View name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate meta methods for components based on their config';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $content = $this->prepareContent();
        $filePath = $this->prepareFilePath();

        $this->createFile($filePath, $content);

        $this->info("{$this->className()} generated on path: ".realpath($filePath));
    }


    /**
     * Prepare content for class file
     *
     * @return string
     */
    protected function prepareContent(): string
    {
        $namespace = $this->namespace();
        $view = $this->prepareView();

        // Prepare params
        $params = [
            '$namespace' => strlen($namespace) < 1 ? '' : 'namespace '.trim($namespace, '\\'),
            '$className' => $this->className(),
            '$viewName' => $view,
            '$defaultField' => ''
        ];

        // Prepare content
        $content = file_get_contents($this->stub);
        foreach ($params as $param => $value) {
            $content = str_replace($param, $value, $content);
        }

        return $content;
    }

    /**
     * Preparing view
     * Create view file if defined not exists file
     *
     * @return string
     */
    protected function prepareView(): string
    {
        $view = $this->option('view');
        if(view()->exists($view) || $view == $this->defaultViewString){
            return $view;
        }

        $viewContent = "{{-- View for element {$this->getCorrectFullClassName()} --}}";
        $viewPath = $view;
        $viewPathPrefix = array_first(config('view.paths'));

        // Update view details if dashboard view needed
        $dashboardViewPrefix = 'dashboard::';
        if(strpos($view, $dashboardViewPrefix) === 0){
            $viewPath = ltrim($view, $dashboardViewPrefix);
            $viewPathPrefix = __DIR__ .'/../../../resources/views/';
        }

        $viewFullPath = str_finish($viewPathPrefix, '/') . str_replace('.', '/', $viewPath) . '.blade.php';

        $this->createFile($viewFullPath, $viewContent);

        $this->info("For defined view name $view created file ".realpath($viewFullPath));

        return $view;
    }

    /**
     * Save content to file
     *
     * @param string $filePath
     * @param string $content
     */
    protected function createFile(string $filePath, string $content)
    {
        // Prepare directory
        $dirname = dirname($filePath);
        if (!is_dir($dirname)) {
            mkdir($dirname);
        }

        file_put_contents($filePath, $content);
    }

    /**
     * Prepare class name
     *
     * @return string
     */
    protected function className(): string
    {
        return class_basename($this->argument('fullClassName'));
    }

    /**
     * Prepare class namespace
     *
     * @param string $className
     *
     * @return string
     */
    protected function namespace(string $className = ''): string
    {
        $className = $className ? $className : $this->className();
        $namespace = rtrim($this->getCorrectFullClassName(), str_start($className, '\\'));

        return $namespace;
    }

    /**
     * Prepare path for class file
     *
     * @return string
     */
    protected function prepareFilePath(): string
    {
        $fullClassName = $this->getCorrectFullClassName();

        // Check if the app namespace used
        $appNamespace = app()->getNamespace();

        if(strpos($fullClassName, $appNamespace) === 0){
            $path = ltrim($fullClassName, $appNamespace);
            $path = str_replace('\\', '/', $path);
            $filePath = app()->path($path).'.php';

            return $filePath;

        }

        if (strpos($fullClassName, $this->dashboardNamespace) === 0) {
            $path = ltrim($fullClassName, $this->dashboardNamespace);
            $path = str_replace('\\', '/', $path);
            $filePath = __DIR__ . "/../../$path.php";

            return $filePath;
        }

        $this->info("Namespace $fullClassName didn't recognized");
        exit;
    }

    /**
     * Prepare full class name
     *
     * @return string
     */
    protected function getCorrectFullClassName()
    {
        return ltrim($this->argument('fullClassName'), '\\');
    }

}

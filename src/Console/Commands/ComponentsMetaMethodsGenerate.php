<?php

namespace Webmagic\Dashboard\Console\Commands;

use Illuminate\Console\Command;
use Webmagic\Dashboard\Core\Content\ContentFieldsUsable;
use Webmagic\Dashboard\Elements\Factories\ElementsFactory;
use Webmagic\Dashboard\Elements\Factories\ElementsRegisterAbleContract;
use Webmagic\Dashboard\MetaGenerators\FactoryMetaMethodsGenerator;
use Webmagic\Dashboard\MetaGenerators\ElementsMetaMethodsGenerator;
use Webmagic\Dashboard\Core\Content\ContentFieldsUsableTrait;

class ComponentsMetaMethodsGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'dashboard:components-meta-methods-generate {class?}';

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
     * @throws \ReflectionException
     */
    public function handle()
    {
        $class = $this->argument('class');

        if ($class) {
            $this->generateForClass($class);

            $this->info("Meta methods generated for $class");

            return;
        }

        $this->generateForKnownElements();
        $this->info("Meta methods generated for all know elements");
    }

    /**
     * Generate meta methods for all registered elements
     *
     * @throws \ReflectionException
     */
    protected function generateForKnownElements()
    {
        $factory = new ElementsFactory();
        $elements = $factory->getRegistered();

        // Update meta data for Factory
        $this->generateForClass(get_class($factory));

        // Update meta data for elements
        foreach ($elements as $elementClass) {
            $this->generateForClass($elementClass);
        }
    }

    /**
     * Generate meta methods for class
     *
     * @param $class
     * @throws \ReflectionException
     */
    protected function generateForClass($class)
    {
        if (!class_exists($class)) {
            $this->error("$class doesn't exists");
            exit;
        }

        $object = app($class);

        switch ($object) {
            case $object instanceof ContentFieldsUsable:
                $generator = new ElementsMetaMethodsGenerator($object);
                break;

            case $object instanceof ElementsRegisterAbleContract:
                $generator = new FactoryMetaMethodsGenerator($object);
                break;

            default:
                $generator = new ElementsMetaMethodsGenerator($object);
                break;
        }

        $generator->generateMetaMethods();
    }
}

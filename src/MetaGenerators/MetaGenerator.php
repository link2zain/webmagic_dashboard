<?php

namespace Webmagic\Dashboard\MetaGenerators;

use ReflectionClass;
use Webmagic\Dashboard\Core\Content\ContentFieldsUsableTrait;

abstract class MetaGenerator
{
    /** @var string template for generating php doc */
    protected $stub = __DIR__ . '/comment_block.stub';

    /** @var string key for placing php docs */
    protected $php_doc_key = PHP_EOL . 'class';

    /** @var ContentFieldsUsableTrait */
    protected $class;

    /** @var ContentFieldsUsableTrait */
    protected $object;

    /**
     * Generate php docs
     * based on defined in attribute classes
     * @throws \ReflectionException
     */
    public function generateMetaMethods()
    {
        $docBlock = $this->generateDocBlock($this->object);

        $this->updateDocBlock($docBlock);
    }

    /**
     * Generate meta data block
     *
     * @param $object
     * @return mixed
     */
    abstract protected function generateDocBlock($object): string ;

    /**
     * Update php docs in current class file
     *
     * @param $docBlock
     * @throws \ReflectionException
     */
    protected function updateDocBlock($docBlock)
    {
        $ref_class = new ReflectionClass($this->object);
        $file_path = $ref_class->getFileName();

        $file = file_get_contents($file_path);

        $key = $this->php_doc_key;

        // Remove old meta methods
        $pattern = preg_quote($this->generateTopPart());
        $newFile = preg_replace("$pattern.*$key/msU", $key, $file);
        $newFile = str_replace(PHP_EOL . PHP_EOL .'/'.$key, $key, $newFile);

        // Add new meta methods
        $file = str_replace($key, $docBlock . $key, $newFile);
        file_put_contents($file_path, $file);
    }

    /**
     * Generate top part of comment block
     *
     * @return string
     */
    protected function generateTopPart()
    {
        $block = PHP_EOL . PHP_EOL;
        $block .= '/*********************************************************************************************************************' . PHP_EOL;
        $block .= ' * Generated meta methods' . PHP_EOL;
        $block .= ' *********************************************************************************************************************' . PHP_EOL;
        $block .= ' *' . PHP_EOL;

        return $block;
    }

    /**
     * Generate bottom part of comment block
     *
     * @return string
     */
    protected function generateBottomPart()
    {
        $block = ' *' . PHP_EOL;
        $block .= ' ********************************************************************************************************************/' . PHP_EOL;

        return $block;
    }
}

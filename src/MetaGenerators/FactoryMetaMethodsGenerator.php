<?php

namespace Webmagic\Dashboard\MetaGenerators;

use ReflectionClass;
use Webmagic\Dashboard\Elements\Factories\ElementsRegisterAbleContract;
use Webmagic\Dashboard\Core\Content\ContentFieldsUsableTrait;

class FactoryMetaMethodsGenerator extends MetaGenerator
{
    /**
     * MetaMethodsGenerator constructor.
     * @param ElementsRegisterAbleContract $object
     */
    public function __construct(ElementsRegisterAbleContract $object)
    {
        $this->class = get_class($object);
        $this->object = $object;
    }


    /**
     * Generate doc block
     *
     * @param ElementsRegisterAbleContract $object
     * @return string
     */
    protected function generateDocBlock($object): string
    {
        $availableParams = $object->getRegistered();
        $block = $this->generateTopPart();

        foreach ($availableParams as $key => $param) {
            $block .= ' * ' . $this->prepareMetaMethodString($key, 'elementAttribute', '', 'null', '\\' . $param) . PHP_EOL;
        }

        $block .= $this->generateBottomPart();

        return $block;
    }


    /**
     * Prepare meta string for method param
     *
     * @param string $methodName
     * @param string $paramName
     * @param string $paramType
     * @param string $default
     * @return string
     */
    protected function prepareMetaMethodString(string $methodName, string $paramName = '', string $paramType = '', string $default = '', string $return = '')
    {
        $paramType = is_bool($paramType) ?:
            $paramType = $paramType === '' || $paramType === 'any' ? '' : (string)$paramType . ' ';
        $default = $default === '' ? $default : "= $default";
        $methodName = camel_case($methodName);

        return "@method $return $methodName($paramType$$paramName $default)";
    }
}

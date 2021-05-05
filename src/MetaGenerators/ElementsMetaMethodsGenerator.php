<?php

namespace Webmagic\Dashboard\MetaGenerators;

use Webmagic\Dashboard\Core\Content\ContentFieldsUsable;

class ElementsMetaMethodsGenerator extends MetaGenerator
{
    /**
     * MetaMethodsGenerator constructor.
     *
     * @param ContentFieldsUsable $object
     */
    public function __construct(ContentFieldsUsable $object)
    {
        $this->class = get_class($object);
        $this->object = $object;
    }

    /**
     * Generate doc block
     *
     * @param ContentFieldsUsable $object
     *
     * @return string
     */
    protected function generateDocBlock($object): string
    {
        $availableParams = $object->getAvailableFields();
        $block = $this->generateTopPart();

        foreach ($availableParams as $param) {
            $type = $object->getFieldType($param);
            $default = $object->getFieldDefaultValue($param);

            $block .= ' * ' . $this->prepareMetaMethodString($param, 'valueOrConfig', $type, '', '\\' . $this->class) . PHP_EOL;
            $block .= ' * ' . $this->prepareMetaMethodString("add_$param", 'valueOrConfig', $type, '', '\\' . $this->class) . PHP_EOL;
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
     * @param string $return
     * @return string
     */
    protected function prepareMetaMethodString(string $methodName, string $paramName = '', string $paramType = '', string $default = '', string $return = '')
    {
        $paramType = is_bool($paramType) ?:
            $paramType = $paramType === '' || $paramType === 'any' ? '' : (string)$paramType . ' ';
        $default = $default === '' ? $default : " = $default";
        $methodName = camel_case($methodName);

        return "@method $return $methodName($paramType$$paramName$default)";
    }
}

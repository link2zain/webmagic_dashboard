<?php


namespace Tests\Unit\Content;


use Webmagic\Dashboard\Core\Content\ContentFieldsUsableTrait;

class Element
{
    use ContentFieldsUsableTrait;

    public function setAttribuitesForTesting(array $attribuites)
    {
        foreach ($attribuites as $name => $value) {
            $this->{$name} = $value;
        }
    }

    /**
     * TestField
     *
     * @return string
     */
    public function getTestFieldSetAsMethod()
    {
        return 'test_value';
    }
}

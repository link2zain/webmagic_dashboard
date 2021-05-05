<?php


namespace Tests\Unit\Content;


use Tests\TestCase;
use Webmagic\Dashboard\Core\Renderable;
use Webmagic\Dashboard\Core\Content\FieldNotValidException;
use Webmagic\Dashboard\Core\Content\FieldUnavailable;
use Webmagic\Dashboard\Core\Content\NoOneFieldsWereDefined;
use Webmagic\Dashboard\Core\Content\UnacceptableValueException;

class ContentFieldUsableTest extends TestCase
{
    /**
     * getDefaultField()
     */
    public function testGetDefaultField()
    {
        //Get default field if it is set
        $el = new Element;
        $default_field_name = 'test_default';
        $el->setAttribuitesForTesting(['default_field' => $default_field_name]);

        $default_field = $el->getDefaultField();
        $this->assertEquals($default_field, $default_field_name);

        //Use first available field as default if default field not set
        $el = new Element;
        $default_field_name = 'test_default';
        $el->setAttribuitesForTesting([
            'available_fields' =>[
                $default_field_name,
                'test_field',
                'next_field'
            ]
        ]);

        $default_field = $el->getDefaultField();
        $this->assertEquals($default_field, $default_field_name);

        //Exception if unset
        $el = new Element;
        $this->expectException(NoOneFieldsWereDefined::class);
        $el->getDefaultField();
    }

    /**
     * getAvailableFields()
     */
    public function testGetAvailableFieldsWhenNotSetException()
    {
        $el = new Element;
        $this->expectException(NoOneFieldsWereDefined::class);
        $el->getAvailableFields();
    }

    public function testGetAvailableFieldsWhenSetEmptyArrayException()
    {
        $el = new Element;
        $el->setAttribuitesForTesting(['available_fields' => []]);
        $this->expectException(NoOneFieldsWereDefined::class);
        $el->getAvailableFields();
    }

    public function testGetAvailableFieldsWhenSet()
    {
        $el = new Element;
        $available_fields = [
            'test_field_1',
            'test_field_2'
        ];
        $el->setAttribuitesForTesting(['available_fields' => $available_fields]);
        $result = $el->getAvailableFields();
        $this->assertEquals($result, $available_fields);
    }

    /**
     * content()
     *
     */
    public function testContent()
    {
        $el = new Element;
        $default_field_name = 'test_default';
        $test_field_name = 'test_field';
        $el->setAttribuitesForTesting([
            'available_fields' =>[
                $default_field_name,
                $test_field_name,
                'other_field'
            ]
        ]);
        $test_content = 'test_def_content';

        //Set content to default field
        $el->content($test_content);
        $this->assertEquals($el->{$default_field_name}, $test_content);

        //Get content from default field
        $this->assertEquals($el->{$default_field_name}, $el->content());

        //Set contents for few fields with array
        $test_content_second = 'test_content';
        $contentArray = [
            $default_field_name => $test_content_second,
            $test_field_name => $test_content
        ];

        $el->content($contentArray);
        $this->assertEquals($el->{$default_field_name}, $test_content_second);
        $this->assertEquals($el->{$test_field_name}, $test_content);
    }

    /**
     * param()
     */
    public function testParam()
    {
        $el = new Element;
        $default_field_name = 'test_default';
        $test_field_name = 'test_field';
        $el->setAttribuitesForTesting([
            'available_fields' =>[
                $default_field_name,
                'test_field',
                'next_field'
            ]
        ]);
        $test_content = 'test_def_content';

        //Set value if field is available
        $el->param($test_field_name, $test_content);
        $this->assertEquals($el->{$test_field_name}, $test_content);

        return $el;
    }

    public function testParamGetIfNotFields()
    {
        $el = new Element;
        $this->expectException(NoOneFieldsWereDefined::class);
        $el->param('unavailable_param_name');
    }

    public function testParamGetIfFieldNameUnavailable()
    {
        $el = new Element;
        $el->setAttribuitesForTesting(['available_fields' =>['test_field']]);
        $this->expectException(FieldUnavailable::class);
        $el->param('unavailable_param_name');
    }

    public function testParamGetIfFieldAvailableSetAsAttribute()
    {
        $el = new Element;
        $test_field_name = 'test_field';
        $test_field_value = 'test_value';
        $el->setAttribuitesForTesting([
            'available_fields' =>[
                $test_field_name
            ],
            $test_field_name =>
                $test_field_value
            ]);

        $value = $el->param($test_field_name);
        $this->assertEquals($value, $test_field_value);
    }

    public function testParamGetIfFieldAvailableSetAsMethod()
    {
        $test_field_name = 'test_field_set_as_method';
        $test_field_value = 'test_value';
        $el = new Element;
        $el->setAttribuitesForTesting([
            'available_fields' =>[
                $test_field_name
            ]
        ]);

        $value = $el->param($test_field_name);
        $this->assertEquals($value, $test_field_value);
    }

    public function testParamGetDefaultIfFieldAvailableButNotSet()
    {
        $test_field_name = 'test_field';
        $test_field_value = 'test_value';
        $el = new Element;
        $el->setAttribuitesForTesting([
            'available_fields' =>[
                $test_field_name
            ]
        ]);

        //If default value not set and field type not set
        $value = $el->param($test_field_name);
        $this->assertEquals($value, '');

        //If default value not set and field type 'string'
        $el->setAttribuitesForTesting([
            'available_fields' =>[
                $test_field_name => [
                    'type' => 'string'
                ]
            ]
        ]);
        $value = $el->param($test_field_name);
        $this->assertEquals($value, '');

        //If default value not set and field type 'bool'
        $el->setAttribuitesForTesting([
            'available_fields' =>[
                $test_field_name => [
                    'type' => 'bool'
                ]
            ]
        ]);
        $value = $el->param($test_field_name);
        $this->assertEquals($value, false);

        //If default value not set and field type 'renderable'
        $el->setAttribuitesForTesting([
            'available_fields' =>[
                $test_field_name => [
                    'type' => 'renderable'
                ]
            ]
        ]);
        $value = $el->param($test_field_name);
        $interfaces = class_implements(get_class($value));
        $this->assertTrue(in_array(Renderable::class, $interfaces));

        //If default value not set and field type 'any'
        $el->setAttribuitesForTesting([
            'available_fields' =>[
                $test_field_name => [
                    'type' => 'bool'
                ]
            ]
        ]);
        $value = $el->param($test_field_name);
        $this->assertEquals($value, '');

        //If default value set
        $el->setAttribuitesForTesting([
            'available_fields' =>[
                $test_field_name => [
                    'default' => $test_field_value
                ]
            ]
        ]);
        $value = $el->param($test_field_name);
        $this->assertEquals($value, $test_field_value);
    }

    /**
     * @throws FieldUnavailable
     * @throws \Exception
     * @throws \Webmagic\Dashboard\Core\Content\Exceptions\ContentTypeException
     * @throws \Webmagic\Dashboard\Core\Content\FieldNotDefined
     *
     * @group test
     */
    public function testParamSetFieldValueIfFieldValue()
    {
        $test_field_name = 'test_field';

        $el = new Element;
        $el->setAttribuitesForTesting([
            'available_fields' =>[
                $test_field_name
            ]
        ]);

        $test_field_value = 'test_value';

        $el->param($test_field_name, $test_field_value);
        $this->assertEquals($el->{$test_field_name}, $test_field_value);
    }

    public function testParamSetFieldValueWithInvalidStringValue()
    {
        $test_field_name = 'test_field';

        $el = new Element;

        //Test string valid and invalid
        $el->setAttribuitesForTesting([
            'available_fields' =>[
                $test_field_name => ['type' => 'string']
            ]
        ]);

        $validString = 'test_value';
        $invalidString = $el;

        //Set with no exception
        $el->param($test_field_name, $validString);

        //Set with exception
        $this->expectException(FieldNotValidException::class);
        $el->param($test_field_name, $invalidString);
    }

    public function testParamSetFieldValueWithInvalidBoolValue()
    {
        //Test bool valid and invalid
        $test_field_name = 'test_field';

        $el = new Element;
        $el->setAttribuitesForTesting([
            'available_fields' =>[
                $test_field_name => ['type' => 'bool']
            ]
        ]);

        $validBool = true;
        $invalidBool = 'string';

        //Set with no exception
        $el->param($test_field_name, $validBool);

        //Set with exception
        $this->expectException(FieldNotValidException::class);
        $el->param($test_field_name, $invalidBool);
    }

    public function testParamSetFieldValueWithInvalidRenderableValue()
    {
        //Test bool valid and invalid
        $test_field_name = 'test_field';

        $el = new Element;
        $el->setAttribuitesForTesting([
            'available_fields' =>[
                $test_field_name => ['type' => 'renderable']
            ]
        ]);

        $validRenderble = $el;
        $invalidObject = $this;
        $invalidRenderble = 'string';

        //Set with no exception
        $el->param($test_field_name, $validRenderble);

        //Set with exception
        $this->expectException(FieldNotValidException::class);
        $el->param($test_field_name, $invalidRenderble);
        $el->param($test_field_name, $invalidObject);
    }

    public function testParamSetFieldValueWithAnyValue()
    {
        //Test bool valid and invalid
        $test_field_name = 'test_field';

        $el = new Element;
        $el->setAttribuitesForTesting([
            'available_fields' =>[
                $test_field_name => ['type' => 'any']
            ]
        ]);

        $validRenderble = $el;
        $invalidString = 'string';
        $invalidBool = true;

        //Set with no exception
        $el->param($test_field_name, $validRenderble);
        $el->param($test_field_name, $invalidString);
        $el->param($test_field_name, $invalidBool);
    }

    public function testParamSetAcceptableAndNotAcceptableField()
    {
        //Test bool valid and invalid
        $test_field_name = 'test_field';
        $testValue = 'test1';

        $el = new Element;
        $el->setAttribuitesForTesting([
            'available_fields' =>[
                $test_field_name => [
                    'acceptable_values' => [$testValue, 'test2']
                ]
            ]
        ]);

        $validValue = $testValue;
        $invalidValue = $testValue . 'invalid';

        //Set with no exception
        $el->param($test_field_name, $validValue);

        $this->expectException(UnacceptableValueException::class);
        $el->param($test_field_name, $invalidValue);
    }

}

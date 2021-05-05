# Create new element
To create new element you can use command:
```
php artisan dashboard:components-generate {fullClassName} --view=dashboard::{viewName}
```
Will be created ElementClass & view.

ElementClass mast extends 'Webmagic\Dashboard\BasicElements\ComplexElement'. 

Also has required parameters:
```php
// string with path to element view
protected $view = 'dashboard::elements.{dir}.{view}';

// array with available element fields (example for color-picker)
protected $available_fields = [
    'id',
    'class' => [
        'default' => 'js-color-pick'
    ],
    'type' => [
        'default' => 'text'
    ],
    'required' => [
        'type' => 'bool',
        'default' => false
    ],
    'value' =>[
        'default' => 'ffffff'
    ],
    'name',
    'data_attributes'
];

// field will be used for default content storing
// if you create element on page without parameters content will be stored to this field
protected $default_field = '{field-name}';
```
After you should register ElementClass in Webmagic\Dashboard\Elements\Factories\ElementsFactory
```php
protected $elements = [
   ...
    '{element}' => {ElementClass}::class,
   ...
];
```
Then generate meta data for ElementClass & Factory:
```
php artisan dashboard:components-meta-methods-generate
```
If Element will be used in forms, need to add method to Webmagic\Dashboard\Components\FormGenerator for example:
```php
public function colorInput(string $name, $valueOrDataSource = null, string $labelTxt = '', bool $required = false)
{
    $value = $this->getData($valueOrDataSource, $name);
    $id = 'id_'.uniqid();

    $this->prepareNextFormGroup($labelTxt, $id)->element()
            ->color()->name($name)->required($required)->id($id)->value($value);

    return $this;
}
```

After we can use Element on page
```php
public function test()
{
    $formGenerator = new FormGenerator();
    $formGenerator->colorInput('color', '', 'Color input');
    
    $page = new BasePage();
    $page->addContent($formGenerator->getForm());

    return $page->render();
}
```
You will see http://joxi.ru/KAxlVloiMNnJzA

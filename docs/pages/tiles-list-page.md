# Tiles list page generation

## Quick start
\Webmagic\Dashboard\Components\TilesListPageGenerator is a best choice for simple data list fast generation. All you need is two level array with data
```php
$tilesListPage = (new \Webmagic\Dashboard\Components\TilesListPageGenerator())
->setItems($data);

return $tilesListPage;
```  

Here is the full example with test data generation
```php
/** @var Generator $faker */
$faker = app(Generator::class);
$data = [];
for ($i = 0; $i < 10; $i++) {
    $data[] = [
        'id' => $faker->numberBetween(0, 100),
        'name' => $faker->name,
        'address' => $faker->address,
        'new' => 'test'
    ];
}


$tilesListPage = (new \Webmagic\Dashboard\Components\TilesListPageGenerator())
->setItems($data);

return $tilesListPage;
```
## Full possibilities
Here is an example with the most of available functionality and configurations

```php
/** @var \Faker\Generator $faker */
$faker = app(Faker\Generator::class);
$data = [];
for ($i = 0; $i < 10; $i++) {
    $data[] = [
        'id' => $faker->numberBetween(0, 100),
        'name' => $faker->name,
        'address' => $faker->address
    ];
}

$paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, 100, 10, 5);

$tilesListPage = (new \Webmagic\Dashboard\Components\TilesListPageGenerator())
    ->title('Tiles page title', 'Tiles page subtitle')
    // Add items
    ->setItems($data)
    // Limit fields to show
    ->setOnly('name', 'tmp', 'second-new-field')
    ->setConfig([
        'tmp' => function (array $item) {
            return $item['name'] . ' : ' . $item['address'];
        }
    ])
    // Add one additional field to content
    ->addToConfig('second-new-field', function ($item) {
        return 'New field startic - ' . $item['id'];
    })
    // Set closure to replace the default rendering
    ->setItemRenderingClosure(function ($item) {
        return app(\Webmagic\Dashboard\Elements\Factories\ElementsFactory::class)
            ->box()->content($item['name'])->makeSimple();
    })
    // Add pagination
    ->withPagination($paginator, url()->current());
    
// Add filtering
$tilesListPage
    // Filter into the box
    ->addFiltering(true)
    ->simpleSelect('name', ['Dan', 'Vincent'], request(), 'Name', true)
    ->dateTimeInput('date', today(), 'Date', false)
    ->submitButton('Filter');

if (request()->ajax()) {
    return $tilesListPage->prepareContent();
}

return $tilesListPage;
```

### View live example

* Activate 'presentation_mode' in config/webmagic/dashboard/dashboard.php
* Visit '/dashboard/tech/tiles-list-page'

## Notifications
You can use quick show methods
```php
$tilesListPage->getPage()->showWarningNotification('Title', 'Text');
$tilesListPage->getPage()->showDangerNotification('Title', 'Text');
$tilesListPage->getPage()->showInfoNotification('Title', 'Text');
$tilesListPage->getPage()->showSuccessNotification('Title', 'Text');
```
Or
```php
$tilesListPage->getPage()->showNotification('Title', 'Text', true, 'info', 'info');
```
Also, you can disable global notifications
```php
$tilesListPage->getPage()->turnOffGlobalNotifications();
```
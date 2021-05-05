# Table page generation

## Quick start
\Webmagic\Dashboard\Components\TablePageGenerator is a best choice for simple table fast generation. All you need is two level array with data
```php
$TablepageGenerator = (new \Webmagic\Dashboard\Components\TablePageGenerator())
        ->items($data);

return $TablepageGenerator;
```  

Here is the full example with test data generation
```php
/** @var \Faker\Generator $faker */
$faker = app(Faker\Generator::class);
$data = [];
for ($i = 0; $i < 10; $i++){
    $data[] = [
        'name' => $faker->name,
        'address' => $faker->address
    ];
}

$TablepageGenerator = (new \Webmagic\Dashboard\Components\TablePageGenerator())
        ->items($data);

return $TablepageGenerator;
```
## Full possibilities
Here is an example with the most of available functionality and configurations

```php
/** @var \Faker\Generator $faker */
            $faker = app(Faker\Generator::class);
            $data = [];
            for ($i = 0; $i < 10; $i++){
                $data[] = [
                    'id' => $faker->numberBetween(0, 100),
                    'name' => $faker->name,
                    'address' => $faker->address
                ];
            }

            $paginator = new \Illuminate\Pagination\LengthAwarePaginator($data, 100, 10, 5);

            $tableGenerator = (new \Webmagic\Dashboard\Components\TablePageGenerator())
                ->title('Page title', 'Page subtitle')
                // Add items
                ->items($data)
                // Set titles
                ->tableTitles('ID', 'Address')
                // Alternative setting titles
                ->tableTitles(['ID', 'Address'])
                // Add additional title
                ->addTableTitle('Address && Name')
                // Add title with sorting
                ->addTitleWithSorting('New field', 'sortingFieldName', 'desc', true, request()->url(), 'GET')
                // Limit fields to show
                ->showOnly('id', 'address', 'address-name', 'new-field', 'second-new-field')
                // Add additional fields and items  fields handlers
                ->setConfig([
                    'address' => function($item){
                        return (new \Webmagic\Dashboard\Elements\Links\Link())->content($item['address'])->link('/');
                    },
                    'address-name' => function($item){
                        return '<b>'.$item['name'].'</b> ('.$item['address'].')';
                    },
                    'new-field' => 'New field static content'
                ])
                // Add one additional field to content
                ->addToConfig('second-new-field', function ($item){
                    return 'New field startic - ' . $item['id'];
                })
                // Add crude links
                ->createLink(url('/'))
                ->setEditLinkClosure(function($item){
                    return url('/edit', ['id' => $item['id']]);
                })
                ->setShowLinkClosure(function($item){
                    return url('/view', ['id' => $item['id']]);
                })
                ->setDestroyLinkClosure(function ($item){
                    return url('/destroy', ['id' => $item['id']]);
                })
                // Add custom element to tool column
                ->addElementsToToolsCollection(function ($item){
                    return (new \Webmagic\Dashboard\Elements\Buttons\DefaultButton())->content($item['name']);
                })
                // Add pagination
                ->withPagination($paginator, request()->url())
                // Add additional tool button
                ->addToolsLinkButton('/', 'New tool button', 'fa-plus')
                // Activate bulk actions functionality
                ->bulkActions([
                    url()->current() => 'Action 1',
                    url('/') => 'Action 2'
                ], function ($item) {
                    return $item['id'];
                })
               // Manual sorting activation
                ->manualSorting(url()->current(), function ($item) {
                    return $item['id'];
                }, 'GET');

            // Add filtering
            $tableGenerator->addFiltering()
                ->action(request()->url())
                ->method('GET')
                ->simpleSelect('name', ['Dan', 'Vincent'], request(), 'Name', true)
                ->dateTimeInput('date', today(), 'Date', false)
                ->submitButton('Filter');
            
            // Return table only for new paginated or filtering page
            if(request()->ajax()){
                return $tableGenerator->getTable();
            }

            return $tableGenerator;
```

### View live example

* Activate 'presentation_mode' in config/webmagic/dashboard/dashboard.php
* Visit '/dashboard/tech/table-page'

## Detailed description

### Add table titles
```php
$TablepageGenerator = (new \Webmagic\Dashboard\Components\TablePageGenerator())
        ->tableTitles('Names', 'Address')
        ->items($data);

return $TablepageGenerator;
```  
The titles will be used for columns from left to right. If title not set for column empty string will be used. The array with titles also available as tableTitles function attribute.

Add additional title
```php 
$TablepageGenerator = (new \Webmagic\Dashboard\Components\TablePageGenerator())
                    ->items($data)
                    ->addTableTitle('Name');
```

### Hide not needed fields
```php
$page = (new \Webmagic\Dashboard\Components\TablePageGenerator())
                    ->items($data)
                    ->showOnly('address');

return $page;
```
## Notifications
You can use quick show methods
```php
$TablepageGenerator->getPage()->showWarningNotification('Title', 'Text');
$TablepageGenerator->getPage()->showDangerNotification('Title', 'Text');
$TablepageGenerator->getPage()->showInfoNotification('Title', 'Text');
$TablepageGenerator->getPage()->showSuccessNotification('Title', 'Text');
```
Or
```php
$TablepageGenerator->getPage()->showNotification('Title', 'Text', true, 'info', 'info');
```
Also, you can disable global notifications
```php
$TablepageGenerator->getPage()->turnOffGlobalNotifications();
```

# Manual sorting in tables

Manual sorting provides a possibility to sort items in table by using Drag&Drop functionality. Implementation includes UI functionality implemented on HTML/CSS/Javascript and simple API implemented on PHP/Laravel

## Activation manual sorting functionality 

Manual sorting activates on table by calling manualSorting() function

```php
use Webmagic\Dashboard\Components\TablePageGenerator;use const Webmagic\Dashboard\Elements\Tables\Observers\ManualSorting\ManualSortingObserver;

$tablePageGenerator = (new TablePageGenerator())
            // Add items
            ->items($data)
            // Manual sorting activation
            ->manualSorting(
                // Url which will be used for request
                url()->current(), 
                // Function for getting ID from items. Item from collection will be put in this function        
                function ($item) {
                    return $item['id'];
                },
                // Method for request. POST as default   
                'GET'
            );
ManualSortingObserver
```

See an example of using this code on the page bottom

## Handle manual sorting on backend

You should define URL for handling the manual sorting on back end and use this url as a first parameter for the manualSorting function. All the details about manual sorting will be sent on this URL. 

The easiest way to get information about manual sorting is to use \Webmagic\Dashboard\Elements\Tables\Observers\ManualSorting\ManualSortingObserver. The easiest way is to use dependency injection. After that you will be able to use a useful API to get info about the manual sorting state.

```php
use Webmagic\Dashboard\Elements\Tables\Observers\ManualSorting\ManualSortingObserver;

public function manualSortingHandling(ManualSortingObserver $manualSorter)
    {
        $manualSorter->itemId();
        $manualSorter->referenceItemId();
        $manualSorter->isItemSetBeforeReference();
        $manualSorter->isItemSetAfterReference();
    }
```
Use given data for sorting your items 

Try to use [boxfrommars/rutorika-sortable](https://github.com/boxfrommars/rutorika-sortable). This package helps organize sorting logic with the same structure and idea. 

As an alternative way you can get manual sorting param manually from Illuminate\Http\Request or request() helper

```php
    $request = app(\Illuminate\Http\Request::class);
    $request->get('entity_id');
    $request->get('reference_entity_id');
    $request->get('reference_type');
```  




# Basic Page

## Create
You can create the default empty page in simple way
```php
$page = new \Webmagic\Dashboard\Pages\BasePage();
```
This code will create empty page with dashboard styles. Basic page implements \Webmagic\Dashboard\Core\Renderable contract and may be simply returned as the result in controller or route function
```php
Route::get('/', function(){
   return new \Webmagic\Dashboard\Pages\BasePage();
});
```
## Create configured
Simple basic page creating give you just template without configured sidebars and other default features. For get fully configured template page get it from the dashboard
```php
Route::get('/', function(){
   return app(\Webmagic\Dashboard\Dashboard::class)->page();
});
```
In this case you will have fully configured basic page

## Content area
The most important and usefully part of the page is content area. You can put inside any content in string format or any objects which implements the \Webmagic\Dashboard\Core\Renderable

Content area is default area for the Basic Page. So you can put content inside with all the next ways
```php
$page = new \Webmagic\Dashboard\Pages\BasePage('Content when create');
$page->content('Update the content');
$page->addContent('Add content content to current');
$page->content(new \Webmagic\Dashboard\Elements\Boxes\Box()); // add renderable element as content
```

## Available areas
Basic pages has getters and setters for the next areas:
* header_logo
* header_nav
* main_sidebar
* content_header
* content
* footer

## Usefully functions

### setPageTitle(string $title, string $subTitle): BasePage
Add \Webmagic\Dashboard\Elements\Titles\H1Title to the ``content_header `` area with given strings. Additionally set meta title with given string
```php
return (new \Webmagic\Dashboard\Pages\BasePage('Content when create'))->setPageTitle('My page title', 'Great sub-title');
```

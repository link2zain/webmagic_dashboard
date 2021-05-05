# Login page

## Create
You can create the default empty login page in simple way
```php
$page = new \Webmagic\Dashboard\Pages\LoginPage();
```
This code will create empty login page. Basic page implements \Webmagic\Dashboard\Core\Renderable contract and may be simply returned as the result in controller or route function
```php
Route::get('/', function(){
   return new \Webmagic\Dashboard\Pages\LoginPage();
});
```

## Available areas
Basic pages has getters and setters for the next areas:
```php
'title' => [
    'default' => 'Login'
],
'logo_link' => [
    'default' => '/'
],
'register_link',
'forgot_password_link',
'before_form',
'form' => [
    'type' => Form::class
],
'after_form'
```

## Usefully functions

### setDefaultForm(string $action = 'login'): LoginPage
Add default login form with possibility to set custom action
```php
return (new \Webmagic\Dashboard\Pages\LoginPage())->setDefaultForm();
```

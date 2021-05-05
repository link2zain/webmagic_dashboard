# Quick start
## Install the package
- Call  ``composer require webmagic/dashboard``to install the package
- Publish assets and configuration files with the next command
```bash
php artisan vendor:publish --tag=webmagic/dashboard::min
```
If you have any issue or need more information see the [installation description](docs/installation.md) for more details
## Generate dashboard page
Let's generate simple dashboard page for fast demonstration. Add the next route with code to the routes/web.php
```php
Route::get('dashboard', function(\Webmagic\Dashboard\Dashboard $dashboard){
   return $dashboard;
});
```
That's is. This code will be generate empty dashboard page with prepared menu sidebar, styles and some other great things. Go to the /dashboard link in your application to see the dashboard page.

You can add any content inside the contend area. Also you have full possibilities to edit any parts of the page. Let's add the simple text to the content area just for quick demonstration. 

Update your code with this
```php
 Route::get('dashboard', function(\Webmagic\Dashboard\Dashboard $dashboard){
   return $dashboard->content('Hello world!');
});
```
After this you will see that string 'Hello world!' was added to the dashboard page content area. 

This is just a small peace of functionality. Please, see the next articles for details about configuration and using the dashboard.
# Installation

## Add package repository
Add webmagic/dashboard repository to ``composer.json`` file
```json
    ...    
    "repositories": [
            {
                "type":"vcs",
                "url":"https://bitbucket.org/webmagic/dashboard"
            },
    
        ],        
    ...
```
Make sure you have permissions for the repository

## Install the package
Call ``composer require webmagic/dashboard v2.0.x-dev`` to install the package.

As alternative add package to ``composer.json`` file
```json
    ...
   "require": {
           "webmagic/dashboard": "v2.0.x-dev"
       },
    ...
```
Call ``composer update`` after the package adding.

## Publishing assets and other
After package installed you have few possibilities to publish assets

For publishing minimal files (assets and configuration file) use the next command
```bash
php artisan vendor:publish --tag=webmagic/dashboard::min
```
Call this command for publishing all files together with views and translations
```bash
 php artisan vendor:publish --tag=webmagic/dashboard::all
```
Also you can call standard Laravel publish function and choose needed option from the list
```bash
php artisan vendor:publish
``` 
Additionally call this command if you want just update the assets after package updated
```bash
php artisan dashboard:assets-update
```

## Configuration
After the configuration file published you have possibility to change some common dashboard options. The most complex of the options is ``menu`` option. This option gives possibility to fully configure the left sidebar menu. See the [main menu description](main-menu.md) for more details
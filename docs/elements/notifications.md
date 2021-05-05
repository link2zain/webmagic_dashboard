# Notifications

## Create
You can create a notification in default way on page
```php
$page = new \Webmagic\Dashboard\Pages\BasePage();
$page->showNotification('Title', 'Text', true, 'info', 'info');
```
Or you can use element factory
```php
$something->addElement('notification_area')
            ->notification()->title(string)->text(string)->button(bool)->type(string)->icon(string);
```

## Quick usage
You can set few types of notifications in quick way: warning, danger, info & success
```php
$page->showWarningNotification('Title', 'Text');
$page->showDangerNotification('Title', 'Text');
$page->showInfoNotification('Title', 'Text');
$page->showSuccessNotification('Title', 'Text');
```

## Available fields
Notification has getters and setters for the next fields:
* title     - (string)
* text      - (string)
* button    - (bool)
* type      - (null|string)
* icon      - (null|string)

## Available types of notifications & default icons
```php
'info'      => 'info',
'danger'    => 'ban',
'warning'   => 'warning',
'success'   => 'check'
```
You can also use another icons


# Notification Service
### NotificationService is a singleton! It's important!
You can push notification to massage bag from everywhere of your code. It will be displayed in global notification area on the page. 
```php
$service = app()->make(Webmagic\Dashboard\NotificationService\NotificationService::class);
$service->addMessage('warning', 'Global note');
``` 
Also, you can disable global notifications by method turnOffGlobalNotifications()
```php
$page->turnOffGlobalNotifications();
```

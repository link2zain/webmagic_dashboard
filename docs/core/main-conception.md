# Main goal and features

The main goal of the "Webmagic Dashboard" package is to provide powerful and flexible functionality for fast admin panel generation with full freedom for modification by the developer

All elements and sections are customizable. The interface generation process is simple and intuitive. You have all possibilities to override the default elements, add your own or do all these together

The additional goal is to provide the build in CRUD functionality for manipulation the models without minimum codding

However, the main feature of the package is flexibility

## Basic principles

The all 



## Elements content using API

The most of elements are based on the ContentUsableTrait. It gives them similar API for adding or getting content. Here are the base principles which elements get after using the ContentUsableTrait

### Fields configuration

All the data which you add to the elements are storing inside the fields. All this fields will be available inside the element view when the rendering process. When you create the element you should define the fields which should be available in your element with using the configuration. The configuration should be added element protected attribute with name ``available_fields ``

Here is the simplest way to define the available fields:
```php
   protected $available_fields = [
        'link',
        'text',
        'icon'
   ]
```
After you defined  fields they will be available inside the view. If you didn't add the content before the rendering all they will have the default values set to empty string

### Common functions
#### 


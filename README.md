# wcr-crud
Laravel crud package

### Install
```
$ composer require wcr/crud
$ php artisan vendor:publish --tag=migrations
$ php artisan migrate
```
### Example
Use CRUD in PostController
```php
<?php

namespace App\Http\Controllers;

use App\Post;
use Wcr\Crud\Http\CrudController;

class PostController extends CrudController
{
    
    public $modelClass = 'App\Post'; // REQUIRED to define the model class

    public $acceptedAttributes = array( 'title', 'body' ); // REQUIRED to define accepted attributes by form

    public $validateRules = array( 'title' => 'required', 'body' => 'required' ); // OPTIONAL to define form validation
    
}
```

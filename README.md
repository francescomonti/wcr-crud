# wcr-crud
Laravel crud package

### Install
```
$ composer require wcr/crud
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
    public $opt = array(
        'item' => 'Post',
        'items' => 'Posts',
        'tableFields' => array('id', 'title')
    );

    public $acceptedAttributes = array( 'title', 'body' );

    public $validateRules = array(
        'title' => 'required',
        'body' => 'required'
    );
    
    public $model = 'App\Post';
}
```

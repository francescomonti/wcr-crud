# wcr-crud
Laravel crud package. The views are optimized for <https://github.com/jeroennoten/Laravel-AdminLTE>

### Required
Laravel 5.5<https://laravel.com/docs/5.5>
Former<https://github.com/formers/former> 

### Install
Download package and setting
```
$ composer require wcr/crud
$ php artisan vendor:publish --tag=migrations
$ php artisan migrate
$ php artisan vendor:publish --tag=abilities
```
We use laravel pre-built authentication
```
$ php artisan make:auth
```

Modify file: `/app/User.php`
```php
<?php

namespace App;

use Wcr\Crud\Rolify;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use Rolify;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
```

### Example
Use CRUD for entity Post:
file: `/app/Http/Controllers/PostController.php`
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
file: `/app/Post.php`
```php
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Wcr\Crud\Entitize;

class Post extends Model
{
    use Entitize;
}
```

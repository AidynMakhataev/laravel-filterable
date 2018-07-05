# LaravelFilterable

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

A laravel package to handle filtering by URL query strings

## Installation

Via Composer

``` bash
$ composer require aidynmakhataev/laravel-filterable
```

## Usage
1. Create a new filter with the following artisan command: 

```bash
php artisan make:filter UserFilter
```

This will create ```App\Http\Filters\UserFilter.php```. You can override the default namespace in **```config/filterable.php```** <br>

```php
return [

    /*
    |--------------------------------------------------------------------------
    | Filters Configuration
    |--------------------------------------------------------------------------
    |
    */

    // namespace for the generated filters
    'namespace' =>  'App\Http\Filters'
];
```
Then, you need to define your filter logic by following this rules:
- Query string without a corresponding filter method are ignored
- Empty strings are ignored
- The value of the each request keys are injected into the corresponding filter method
- You are able to access the eloquent query builder instance by using ```$this->builder```

**Example**: <br>

For defining methods for the following url request:

``` http://yourdomain.com/api/users?gender=male&working=1  ```

<br>

You would use the following methods:


```php
namespace App\Http\Filters;

use AidynMakhataev\LaravelFilterable\BaseFilter;

class UserFilter extends BaseFilter
{
    public function gender($value)
    {
        return $this->builder->where('gender', $value);
    }

    public function working($value)
    {
        return $this->builder->where('is_working', $value);
    }
}
```


2. Add the trait and bind created in step 1 Filter Class to your model.

 ```php
use AidynMakhataev\LaravelFilterable\Filterable;

class User extends Authenticatable
{
    use Filterable;

    /**
     * Filters attribute.
     *
     * @var array
     */
    protected $filters = \App\Http\Filters\UserFilter::class;

}
```

3. Finally, use it in your Controller:
```php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::filter($request->all())->get();

        return response()->json($users);
    }
}
```

## Contributing

Anyone is welcome to contribute. Fork, make your changes, and then submit a pull request.

## Security

If you discover any security related issues, please email makataev.7@gmail.com instead of using the issue tracker.

## Credits

- [Aidyn Makhataev][link-author] 

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/aidynmakhataev/laravelfilterable.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/aidynmakhataev/laravelfilterable.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/aidynmakhataev/laravelfilterable/master.svg?style=flat-square
[ico-styleci]: https://github.styleci.io/repos/139683973/shield

[link-packagist]: https://packagist.org/packages/aidynmakhataev/laravel-filterable
[link-downloads]: https://packagist.org/packages/aidynmakhataev/laravel-filterable
[link-travis]: https://travis-ci.org/aidynmakhataev/laravelfilterable
[link-styleci]: https://github.styleci.io/repos/139683973
[link-author]: https://github.com/AidynMakhataev
[link-contributors]: ../../contributors]
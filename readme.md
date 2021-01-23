# Log User Activity For Backpack

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

A simple interface for [spatie/laravel-activitylog](https://github.com/spatie/laravel-activitylog/) for [Laravel Backpack](https://github.com/Laravel-Backpack/CRUD).

## Installation

1) In your terminal

```bash
# install the package with composer
$ composer require coziboy/log-user-activity-for-backpack

# [optional] Add a sidebar_content item for it
php artisan backpack:add-sidebar-content "<li class='nav-item'><a class='nav-link' href='{{ backpack_url('log-user') }}'><i class='nav-icon la la-history'></i> Log User Activity</a></li>"
```

2) Finish all installation steps for [spatie/laravel-activitylog](https://github.com/spatie/laravel-activitylog#installation), which has been pulled as a dependency. Run its migrations. Most likely it's:
```bash
php artisan vendor:publish --provider="Spatie\Activitylog\ActivitylogServiceProvider" --tag="migrations"
php artisan migrate
// To make this work all you need to do is let your model use the Spatie\Activitylog\Traits\LogsActivity-trait
```

3) Change guard configuration values in ```config/backpack/base.php```
``` bash
'guard' => null,
```

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email tolong@buatin.website instead of using the issue tracker.

## Credits

- [Andreas Asatera][link-author]
- [All Contributors][link-contributors]

## License

MIT. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/coziboy/log-user-activity-for-backpack.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/coziboy/log-user-activity-for-backpack.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/coziboy/log-user-activity-for-backpack/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/332005229/shield

[link-packagist]: https://packagist.org/packages/coziboy/log-user-activity-for-backpack
[link-downloads]: https://packagist.org/packages/coziboy/log-user-activity-for-backpack
[link-travis]: https://travis-ci.org/coziboy/log-user-activity-for-backpack
[link-styleci]: https://styleci.io/repos/332005229
[link-author]: https://github.com/coziboy
[link-contributors]: ../../contributors

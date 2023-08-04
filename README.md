# Quick Debug for laravel 

The Laravel Quick Debug package helps you to find dd,exit or anything.

[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

## Installation

You can install the package via composer:

```bash
composer require dhr/laravel-quick-debug
```
### Usage

Use the below command for find dd and exit from the project.  

```
php artisan quick:debug
```
You can find any specific string from the project like below. It will find "store" string in the whole project.

```
php artisan quick:debug store
```
### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Security

If you discover any security-related issues, please email gordhrumil0077@gmail.com instead of using the issue tracker.

## Credits

- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

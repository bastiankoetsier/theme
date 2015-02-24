# UNDER DEVELOPMENT - NO PRODUCTION-USE

# Requirements

**This Package is only for [Laravel 5+](https://github.com/laravel/laravel)**

# Installation

Pull in via composer
```js
{
    "require": {
                "bkoetsier/theme": "dev-master"
                }
}
```
## Register Provider

```php
// app/config/app.php

'providers' => [
    '...',
    'Bkoetsier\Theme\ThemeServiceProvider',
];
```

## Themes-Config
As default, this packages expects your themes placed in
> LARAVEL-ROOT/resources/views/

If you want to override it, you should publish the config with
```php
php artisan vendor:publish --provider="Bkoetsier\Theme\ThemeServiceProvider"
```
You can modify the themes-root in the new app/config/themes.php.



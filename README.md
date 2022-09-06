# Streamline Business Rules inside your Laravel app

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jafar-albadarneh/laravel-business-rules.svg?style=flat-square)](https://packagist.org/packages/jafar-albadarneh/laravel-business-rules)
[![GitHub Tests Action Status](https://img.shields.io/github/workflow/status/jafar-albadarneh/laravel-business-rules/run-tests?label=tests)](https://github.com/jafar-albadarneh/laravel-business-rules/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/workflow/status/jafar-albadarneh/laravel-business-rules/Fix%20PHP%20code%20style%20issues?label=code%20style)](https://github.com/jafar-albadarneh/laravel-business-rules/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/jafar-albadarneh/laravel-business-rules.svg?style=flat-square)](https://packagist.org/packages/jafar-albadarneh/laravel-business-rules)

If your App follows actions pattern, you can use this package to streamline your business rules along the lines of your actions.

## Installation

You can install the package via composer:

```bash
composer require jafar-albadarneh/laravel-business-rules
```

## Usage

```php
$laravelBusinessRules = new Jafar\LaravelBusinessRules();
echo $laravelBusinessRules->echoPhrase('Hello, Jafar!');
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [jafar-albadarneh](https://github.com/jafar-albadarneh)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

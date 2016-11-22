# Locale to Yaml

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This package provides artisan commands to export language files from PHP to Yaml. Then, import it back to PHP. 

## Install

Via Composer

``` bash
$ composer require ellipsesynergie/locale-to-yaml
```

## Usage

``` php
...
```

### Laravel

First, add `EllipseSynergie\LocaleToYaml\LocaleToYamlServiceProvider::class` to `providers` of config file `app.php`. 

#### Export

```
php artisan lang:export-to-yaml resources/lang/en/app.php
```

#### Import

```
php artisan lang:import-from-yaml resources/lang/en/app.yml resources/lang/en/app.php
```

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test tests/
```

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.

## Security

## Credits

- [Ellipse Synergie][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/ellipsesynergie/locale-to-yaml.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/ellipsesynergie/locale-to-yaml/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/ellipsesynergie/locale-to-yaml.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/ellipsesynergie/locale-to-yaml.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/ellipsesynergie/locale-to-yaml.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/ellipsesynergie/locale-to-yaml
[link-travis]: https://travis-ci.org/ellipsesynergie/locale-to-yaml
[link-scrutinizer]: https://scrutinizer-ci.com/g/ellipsesynergie/locale-to-yaml/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/ellipsesynergie/locale-to-yaml
[link-downloads]: https://packagist.org/packages/ellipsesynergie/locale-to-yaml
[link-author]: https://github.com/ellipsesynergie
[link-contributors]: ../../contributors

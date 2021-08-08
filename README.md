![Addon Demo](https://github.com/doublethreedigital/duplicator/raw/master/demo.gif)

## Duplicator

Duplicator makes it painless for content editors to duplicate existing entries & terms, right from within the Statamic Control Panel.

This repository contains the source code of Duplicator. While Duplicator itself is free and doesn't require a license, you can [donate to Duncan](https://duncanmcclean.com/donate), the developer behind it to show your appreciation.

## Installation

1. Install via Composer - `composer require doublethreedigital/duplicator`
2. Publish the configuration file *(optional)* - `php artisan vendor:publish --tag="duplicator-config"`
3. Start duplicating!

## Documentation

### Configuration

If you optionally publish the configuration file during installation, it should be present at `config/duplicator.php`. If not, you may publish the config file with the following command:

```
php artisan vendor:publish --tag="duplicator-config"
```

The config file looks like this:

```php
<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Defaults
    |--------------------------------------------------------------------------
    |
    | Set defaults for duplicated entries.
    |
    */

    'defaults' => [
        'published' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Fingerprint
    |--------------------------------------------------------------------------
    |
    | Should Duplicator leave a 'fingerprint' on each entry/term/asset it touches
    | so you can tell if it's a duplicated entry or not?
    |
    */

    'fingerprint' => false,

];
```

**Configuration options**

* `defaults` - You can configure defaults for duplicated entries. For example, if duplicated entries should be published or not. If not configured, it will fallback to the status of the entry being duplicated.
* `fingerprint` - Disabled by default. You can choose whether you'd like a 'fingerprint', in the way of an extra `is_duplicate` variable, to be added to entries/terms/assets duplicated by this addon.

### Usage

#### Collection Entries

> **🔥 Hot Tip:** Make sure you're on the `List` entries view, not the `Tree` one or else you won't see the `Duplicate` button.

1. Go to a Collection, and view the entries listing.
2. Decide on the entry you wish to duplicate. Click the three dots to toggle a dropdown and click the `Duplicate` option.
3. If you've got a multi-site setup, you'll be asked to select the site you wish to duplicate the entry to. Select and option and continue.
4. The entry will then be duplicated!

#### Taxonomy Terms

1. Go to a Taxonomy, and view the terms listing.
2. Decide on the term you wish to duplicate. Click on the three dots to toggle a dropdown and click the `Duplicate` option.
3. The term will then be duplicated!

### Translations

Thanks to the community, Duplicator provides localized translations in English, French, German & Dutch. If you need translations in another language, you can create them yourself.

First, create the transalation file in `resources/lang/vendor/duplicator/{language}/messages.php`. You should be able to copy the [English translation file](https://github.com/doublethreedigital/duplicator/blob/master/resources/lang/en/messages.php) and make your changes from there.

## Security

From a security perspective, the latest version only will receive a security release if a vulnerability is found.

If you discover a security vulnerability within Duplicator, please report it [via email](mailto:duncan@doublethree.digital) straight away. Please don't report security issues in the issue tracker.

## Resources

* [**Issue Tracker**](https://github.com/doublethreedigital/duplicator/issues): Find & report bugs in Duplicator
* [**Email**](mailto:help@doublethree.digital): Support from the developer behind the addon

---

<p>
<a href="https://statamic.com"><img src="https://img.shields.io/badge/Statamic-3.0+-FF269E?style=for-the-badge" alt="Compatible with Statamic v3"></a>
<a href="https://packagist.org/packages/doublethreedigital/duplicator/stats"><img src="https://img.shields.io/packagist/v/doublethreedigital/duplicator?style=for-the-badge" alt="Duplicator on Packagist"></a>
</p>

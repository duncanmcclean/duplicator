![Addon Demo](https://github.com/doublethreedigital/duplicator/raw/master/demo.gif)

# Duplicator

Duplicator makes it painless for content editors to duplicate existing entries, right from within the Statamic Control Panel.

While Duplicator itself is free and doesn't require a license, you can [optionally donate to Duncan](https://duncanm.dev/donate), the developer behind it to show your appreciation.

## Installation

1. Install via Composer - `composer require doublethreedigital/duplicator`
2. Publish the configuration file *(optional)* - `php artisan vendor:publish --tag="duplicator-config"`
3. Start duplicating!

## Configuration

If you publish the configuration file during installation, the config file should be present at `config/duplicator.php`.

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

];
```

Currently, the configuration file allows you to configure defaults for duplicated entries. For example, if duplicated entries should be published or not. If not configured, it will fallback to the status of the entry being duplicated.

## Usage

> **🔥 Hot Tip:** Make sure you're on the `List` entries view, not the `Tree` one or else you won't see the `Duplicate` button.

1. Go to a Collection, and view the entries listing.
2. Decide on the entry you wish to duplicate. Click the three dots to toggle a dropdown and click the `Duplicate` option.
3. If you've got a multi-site setup, you'll be asked to select the site you wish to duplicate the entry to. Select and option and continue.
4. The entry will then be duplicated!

## Translations

Duplicator provides localized translations in both English and French. If you need translations in another language, you can create them yourself.

First, create the transalation file in `resources/lang/vendor/duplicator/{language}/messages.php`. You should be able to copy the [English translation file](https://github.com/doublethreedigital/duplicator/blob/master/resources/lang/en/messages.php) and make your changes from there.

## Support

For developer support or any other questions related to this addon, please [get in touch](mailto:hello@doublethree.digital).

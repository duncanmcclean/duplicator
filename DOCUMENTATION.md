## Configuration

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
    | Ignored fields
    |--------------------------------------------------------------------------
    |
    | Configure any fields which should be ignored when duplicating items.
    |
    */

    'ignored_fields' => [
        'assets' => [
            // 'field_handle',
        ],

        'entries' => [
            // 'collection_handle' => [
            //     'field_handle',
            // ],
        ],

        'terms' => [
            // 'taxonomy_handle' => [
            //     'field_handle',
            // ],
        ],
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

- `defaults` - You can configure defaults for duplicated entries. For example, if duplicated entries should be published or not. If not configured, it will fallback to the status of the entry being duplicated.
- `ignored_fields` - You can configure any fields you wish to be ignored when duplicating entries/terms/assets. You may set different ignored fields per collection/taxonomy.
- `fingerprint` - Disabled by default. You can choose whether you'd like a 'fingerprint', in the way of an extra `is_duplicate` variable, to be added to entries/terms/assets duplicated by this addon.

## Usage

### Assets

1. Go to the 'Assets' page within the Control Panel
2. Decide on the asset you wish to duplicate, then click on the asset. You should get the option to 'Duplicate' the asset.
3. The asset will then be duplicated.

### Collection Entries

> **🔥 Hot Tip:** Make sure you're on the `List` entries view, not the `Tree` one or else you won't see the `Duplicate` button.

1. Go to a Collection, and view the entries listing.
2. Decide on the entry you wish to duplicate. Click the three dots to toggle a dropdown and click the `Duplicate` option.
3. If you've got a multi-site setup, you'll be asked to select the site you wish to duplicate the entry to. Select and option and continue.
4. The entry will then be duplicated!

### Forms

> **Note:** The fingerprint feature isn't available for forms as they don't allow for storing extra bits of data.

1. Go to the 'Forms' page within the Control Panel
2. Decide on the form you wish to duplicate. Click on the three dots to toggle a dropdown and click the `Duplicate` option.
3. The form will then be duplicated!

### Taxonomy Terms

1. Go to a Taxonomy, and view the terms listing.
2. Decide on the term you wish to duplicate. Click on the three dots to toggle a dropdown and click the `Duplicate` option.
3. The term will then be duplicated!

## Translations

Thanks to the community, Duplicator provides localized translations in English, French, German & Dutch. If you need translations in another language, you can create them yourself.

First, create the transalation file in `resources/lang/vendor/duplicator/{language}/messages.php`. You should be able to copy the [English translation file](https://github.com/doublethreedigital/duplicator/blob/master/resources/lang/en/messages.php) and make your changes from there.

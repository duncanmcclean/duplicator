<!-- statamic:hide -->

![Banner](./banner.png)

## Duplicator

<!-- /statamic:hide -->

**This addon has been archived.** Its functionality was added to Statamic Core as part of [v3.3.59](https://github.com/statamic/cms/releases/tag/v3.3.59) and [v4.30.0](https://github.com/statamic/cms/releases/tag/v4.30.0). 

After updating to the latest Statamic version, you may uninstall this addon from your project:

```
composer remove doublethreedigital/duplicator
```

## Installation

> If you're not using multi-site, please update to Statamic 3.3.59 or above instead of installing this addon.

First, require Duplicator as a Composer dependency:

```
composer require doublethreedigital/duplicator
```

Now you can start duplicating!

## Usage

### Collection Entries

> **🔥 Hot Tip:** Make sure you're on the `List` entries view, not the `Tree` one or else you won't see the `Duplicate` button.

1. Go to a Collection, and view the entries listing.
2. Decide on the entry you wish to duplicate. Click the three dots to toggle a dropdown and click the `Duplicate` option.
3. If you've got a multi-site setup, you'll be asked to select the site you wish to duplicate the entry to. Select and option and continue.
4. The entry will then be duplicated!

### Taxonomy Terms

1. Go to a Taxonomy, and view the terms listing.
2. Decide on the term you wish to duplicate. Click on the three dots to toggle a dropdown and click the `Duplicate` option.
3. The term will then be duplicated!

## Support

No new features are being added to this addon. Currently, it's only purpose is for providing the 'Duplicate' functionality for multi-sites.

Once Statamic has implemented the Duplicate actions for multi-sites, this addon will be archived. Please leave a 👍 reaction on the [Statamic feature request](https://github.com/statamic/ideas/issues/942).

<!-- statamic:hide -->

---

<p>
<a href="https://statamic.com"><img src="https://img.shields.io/badge/Statamic-3.4+-FF269E?style=for-the-badge" alt="Compatible with Statamic v3"></a>
<a href="https://packagist.org/packages/doublethreedigital/duplicator/stats"><img src="https://img.shields.io/packagist/v/doublethreedigital/duplicator?style=for-the-badge" alt="Duplicator on Packagist"></a>
<a href="https://tuple.app"><img src="https://img.shields.io/badge/Pairing%20with-Tuple-5A67D8?style=for-the-badge" alt="Pairing with Tuple"></a>
</p>

<!-- /statamic:hide -->

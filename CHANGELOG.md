# Changelog

## Unreleased

## v2.3.1 (2022-06-20)

### What's fixed

- Fixed an issue where the Duplicate action could (in theory) show on Forms, even if the site isn't on a high enough Statamic version for it to work

## v2.3.0 (2022-06-13)

### What's new

- You can now duplicate **Forms!** 🎉 #38 #44 by @duncanmcclean

## v2.2.0 (2022-04-15)

### What's new

- You may now ignore certain fields when duplicating #39 #42 by @duncanmcclean
- You may now duplicate entries to all sites, in addition to just a specific one #41 #43 by @duncanmcclean

## v2.1.1 (2022-02-26)

### What's new

- Statamic 3.3 support

## v2.1.0 (2021-12-30)

### What's new

- PHP 8.1 Support #35

### Breaking changes

- Dropped Laravel 6 support
- Dropped PHP 7.3 support

## v2.0.1 (2021-10-22)

### What's fixed

- Fixed an issue with collections with a no-root structure

## v2.0.0 (2021-09-16)

From **v2.0.0** onwards, Duplicator only supports Statamic 3.2 onwards.

### What's fixed

- Entry dates are now duplicated along with rest of entry #30
- Fixed issue with collection trees in Statamic 3.2 #31

## v1.3.4 (2021-08-19)

### What's new

- Support for [Statamic 3.2](https://statamic.com/blog/statamic-3.2-beta)

## v1.3.3 (2021-06-10)

### What's new

- A 'fingerprint' toggle. [See documentation](https://github.com/doublethreedigital/duplicator#configuration) #27

## v1.3.2 (2021-05-24)

### What's new?

- You can now duplicate assets!

## v1.3.1

- German Translation #25

## v1.3.0

### What's new

- You can now duplicate taxonomy terms #24

### What's fixed

- You can no longer see the Duplicator actions when in bulk for resources not supported.

## v1.2.8

- Tests would fail if Duplicator was installed #23

## v1.2.7

- Dutch translation #22

## v1.2.6

- Support for [Statamic 3.1](https://statamic.com/blog/statamic-3.1-lunch-party)

## v1.2.5

- French translations #20
- Ability to set default published state for duplicated entries, via new duplicator.php config file. #19

## v1.2.4

- [fix] Fixed an error that would happen when publishing translations.

## v1.2.3

- Allow for duplicating bulk entries at once.
- Improve the way titles and slugs of duplicated entries are generated. #10

## v1.2.2

- [fix] Fixed issues with collection structures #14

## v1.2.1

- Fixed bug when duplicating an entry, where the collection isn't structured. #13

## v1.2.0

- [new] Duplicated entries will use the same parent in the collection structure, instead of falling to the root. #12

## v1.1.1

- Fixed bug when duplicating entries on multi-sites.

## v1.1.0

Duplicator now gives you the option to select a site to duplicate to (if you're using a multi-site setup).

## v1.0.5

- Officially supports Statamic 3 (not beta)

## v1.0.4

- Action text and title, slug stuff can now be localised, #3

## v1.0.3

Now compatible with Statamic 3 Beta 31!

## v1.0.2

- Fix issue with blueprints being duplicated - thanks @johncarter-

## v1.0.1

Fully tested and a small bit of refactoring

## v1.0.0

> Initial Release

Virtual Currency Library
==========================
( Version 3.0 )
- - -

This library provides a business logic of the extension Virtual Currency. You can use it to any framework.
Virtual Currency is Joomla! extension that provides functionality, API and resources to manage virtual money and goods on Joomla! websites.

## Installation

The preferred method of installation is via [Packagist][] and [Composer][]. Run the following command to install the package and add it as a requirement to your project's `composer.json`:

```bash
composer require it-prism/virtual-currency-library
```

##Documentation

You can find documentation on following pages.

[Documentation and FAQ](http://itprism.com/help/111-virtual-currency-documentation)

[API documentation](http://cdn.itprism.com/api/virtualcurrency/index.html)

##Download

You can [download VirtualCurrency package](http://itprism.com/free-joomla-extensions/ecommerce-gamification/virtual-currency-accounts-manager) from the website of ITPrism.

[Distribution repository](https://github.com/ITPrism/VirtualCurrencyDistribution)

##License

Virtual Currency is under [GPLv3 license](http://www.gnu.org/licenses/gpl-3.0.en.html).

## Building Joomla! package

If you would like to build a package that you will be able to install on your Joomla! website, follow next steps.

_**NOTE**: Use this option if you would like to upgrade the library urgently. The component Virtual Currency contains the library and it will be overridden when you upgrade the component on Joomla! CMS._

You will have to [install Apache Ant](http://ant.apache.org/manual/install.html) on your PC.

1. Download this repository via Composer or manually.
2. Open your console and go to folder __build__.
3. Rename file _antconfig.dist.txt_ to _antconfig.txt_.
4. Edit the path to the folder where the library is. You have to enter the path as value of variable __cfg.sourceDir__ in _antconfig.txt_.
5. Execute `ant` in your console.

```bash
ant
```

Features
--------

* PSR-4 autoloading compliant structure
* Unit-Testing with PHPUnit
* Comprehensive Guides and tutorial
* Easy to use to any framework or even a plain php file

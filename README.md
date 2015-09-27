Imagine Bundle
========

[![Build Status](https://api.shippable.com/projects/54f27f7b5ab6cc13528fd49d/badge?branchName=master)](https://app.shippable.com/projects/54f27f7b5ab6cc13528fd49d/builds/latest) [![SensioLabsInsight](https://insight.sensiolabs.com/projects/de432dc1-43ff-4228-b4db-30b244241724/mini.png)](https://insight.sensiolabs.com/projects/de432dc1-43ff-4228-b4db-30b244241724)
[![Code Climate](https://codeclimate.com/github/jdgriffith/CodeGod/badges/gpa.svg)](https://codeclimate.com/github/jdgriffith/CodeGod)

This project has a console command which will create classes from yaml files.

Installation
============

Step 1: Download the Bundle
---------------------------

Open a command console, enter your project directory and execute the
following command to download the latest stable version of this bundle:

```bash
$ composer require <package-name> "~1"
```

This command requires you to have Composer installed globally, as explained
in the [installation chapter](https://getcomposer.org/doc/00-intro.md)
of the Composer documentation.

Step 2: Enable the Bundle
-------------------------

Then, enable the bundle by adding it to the list of registered bundles
in the `app/AppKernel.php` file of your project:

```php
<?php
// app/AppKernel.php

// ...
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...

            new <vendor>\<bundle-name>\<bundle-long-name>(),
        );

        // ...
    }

    // ...
}
```

How to Use
----------

As of right now, you only have to run the following command:

```
app/console generate:class --file=Class.yml
```

This will effectively create all the classes and interfaces in your Yaml file. The example Class.yml file is included in this project.




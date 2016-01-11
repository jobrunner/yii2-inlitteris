# Getting started with yii2-inlitteris

### 1. Install

yii2-inlitteris module can be installed using composer. Run following command to download and install InLitteris:

```bash
composer require "jobrunner/yii2-inlitteris:0.1.*@dev"
```

### 2. Configure

Add following lines to your main configuration file:

```php
'modules' => [
    'inlitteris' => [
        'class' => 'jobrunner\inlitteris\Module',
    ],
],
```

### 3. Update database schema

The last thing you need to do is updating your database schema by applying the
migrations. Make sure that you have properly configured `db` application component
and run the following command:

```bash
$ php yii migrate/up --migrationPath=@vendor/jobrunner/yii2-inlitteris/migrations
```

### 4. Using citeproc-php

As an option yii2-inlitteris module works with citeproc-php extension for enhanced citation styles using the 
XML based CSL (Citation Style Language). Just add it to your composer.json and run update command: 

```bash
composer require "academicpuma/citeproc-php":"1.0.0"
composer update
```

Change your main configuration:

```php
'modules' => [
    'inlitteris' => [
        'class' => 'jobrunner\inlitteris\Module',

        // configure a default style from csl repo:
        'defaultCitationStyle'   => 'apa-annotated-bibliography',
        
        // use citeproc-php as an extension:
        'extensionMap' => [
            'CiteProcessor' => [
                'class'        => 'AcademicPuma\CiteProc\CiteProc',
            ]
        ],
        
    ],
],
```

## Where do I go now?

Hm, it's my little experiment. Sorry.

## Troubleshooting

See "Where do I go now?" and shoot the trouble...

## License

I think, the license of citeproc-php package is not compatible with the MIT license. Therefore it is my aim to 
use citeproc-php realy optional in the feature.
# Getting started with Yii2-ReferenceManager

### 1. Install

InLitteris module can be installed using composer. Run following command to download and install InLitteris:

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

## Where do I go now?

Hm, it's my little experiment. Sorry.

## Troubleshooting

See "Where do I go now?" and shoot the trouble...

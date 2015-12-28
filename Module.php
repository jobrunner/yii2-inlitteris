<?php
/*
 * This file is part of the inlitteris project.
 *
 * (c) Jo Brunner <http://github.com/jobrunner/yii2-inlitteris>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace jobrunner\inlitteris;

use \yii\base\Module as BaseModule;
use yii\i18n\PhpMessageSource;

/**
 * This is the main module class for the yii2-inlitteris.
 *
 * @package jobrunner\inlitteris
 * @author Jo Brunner <jo@mett.io>
 */
class Module extends BaseModule
{
    public $controllerNamespace = 'jobrunner\inlitteris\controllers';

    public $controllerMap = [
        'references' => 'jobrunner\inlitteris\controllers\ReferenceController',
    ];

    public $modelMap = [
        'Reference'         => 'jobrunner\inlitteris\models\Referece',
        'ReferenceType'     => 'jobrunner\inlitteris\models\RefereceType',
        'ReferenceSetting'  => 'jobrunner\inlitteris\models\RefereceSetting',

    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $app = \Yii::$app;

        // register "inlitteris" namespace for translation messages
        if (!isset($app->get('i18n')->translations['inlitteris'])) {
            $app->get('i18n')->translations['inlitteris'] = [
                'class'    => PhpMessageSource::className(),
                'sourceLanguage' => 'en',
                'basePath' => __DIR__ . '/messages',
            ];
        }
    }
}

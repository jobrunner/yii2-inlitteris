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

use Yii;
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

    protected $_controllerMap = [
        'references' => 'jobrunner\inlitteris\controllers\ReferenceController',
    ];

    /** @var array Model's map */
    protected $_modelMap = [
        'Reference'         => 'jobrunner\inlitteris\models\Reference',
        'ReferenceType'     => 'jobrunner\inlitteris\models\ReferenceType',
        'ReferenceSetting'  => 'jobrunner\inlitteris\models\ReferenceSetting',
        'ReferenceSearch'   => 'jobrunner\inlitteris\models\ReferenceSearch',
        'CitationStyle'     => 'jobrunner\inlitteris\models\CitationStyle',
    ];

    /** @var array Model map */
    public $modelMap = [];

    /** @var array Controller map */
    public $controllerMap = [];

    /** @var array Extension map */
    public $extensionMap = [
        'CiteProcessor'     => 'jobrunner\inlitteris\api\CiteProcessor'
    ];

    /** @var int Default reference type */
    public $defaultReferenceTypeId = 0;

    /** @var string Default citation style */
    public $defaultCitationStyle = 'default';


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

        $this->modelMap = array_merge($this->_modelMap, $this->modelMap);

        foreach ($this->modelMap as $name => $class) {
            Yii::$container->set($name, $class);
        }

        foreach ($this->extensionMap as $name => $definition) {
            $class      = 'jobrunner\\inlitteris\api\\' . $name;
            $extName    = is_array($definition) ? $definition['class'] : $definition;

            Yii::$container->set($class, $definition);

            if ('CiteProcessor' == $name) {
                Yii::$container->set($name, function () use ($extName) {

                    return new $extName();
                });
            }
        }
    }
}

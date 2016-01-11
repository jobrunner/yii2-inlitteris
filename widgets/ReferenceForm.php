<?php
/*
 * This file is part of the inlitteris project.
 *
 * (c) Jo Brunner <http://github.com/jobrunner/yii2-inlitteris>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace jobrunner\inlitteris\widgets;

use Yii;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use jobrunner\inlitteris\models\Reference;

class ReferenceForm extends \yii\base\Widget
{
    /** @var  Reference */
    public $model;

    public $options = [];

    public $buttonClass = 'btn btn-success';
    public $buttonText;

    protected $_citeProcessor = null;


    public function init()
    {
        parent::init();

        if (empty($this->buttonText)) {
            $this->buttonText  = Yii::t('inlitteris', 'Create Reference From default');
        }
    }


    public function run()
    {
        return $this->render('reference-opener', [
            'model'    => $this->model,
            'widgetId' => $this->getId(),
            'buttonClass' => $this->buttonClass,
            'buttonText'  => $this->buttonText,
            'updateUrl' => '#',
            'createUrl' => '#'
        ]);
    }
}
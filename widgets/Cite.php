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

use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Url;
use jobrunner\inlitteris\models\Reference;

class Cite extends \yii\base\Widget
{
    /** @var  Reference */
    public $model;

    public function init()
    {
        parent::init();

        if ($this->model == null) {
            throw new InvalidConfigException('model must be set in LabelList widget.');
        }
    }

    public function run()
    {

        return $this->render('cite', [
            'model' => $this->model,
            'widgetId' => $this->getId(),
        ]);
    }
}
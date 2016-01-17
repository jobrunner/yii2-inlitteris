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
use jobrunner\inlitteris\api\Citation\Mapper\CiteProcMapper;

/**
 * Citation widget
 *
 * @package jobrunner\inlitteris\widgets
 */
class Citation extends \yii\base\Widget
{
    /** @var  Reference */
    public $model;

    /**
     * @var string CSL (Cite Style Language) XML configuring optional citeproc-php
     */
    public $csl;

    /**
     * @var string RFC 1766 language code used by a CiteProcessor
     */
    public $locale = 'en-US';


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->model == null) {
            throw new InvalidConfigException('model must be set in Citation widget.');
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $citeProcessor = Yii::createObject('CiteProcessor');
        $citeProcessor->init($this->csl, $this->locale);

        $mapper                 = new CiteProcMapper($this->model);
        $reference              = $mapper->map();
        $references[$this->model->id] = $reference;

        return $this->render('citation', [
            'widgetId'  => $this->getId(),
            'reference' => $reference,
            'row'       => function($reference, $mode) use ($citeProcessor) {
                return $citeProcessor->render($reference, $mode);
            }
        ]);
    }
}
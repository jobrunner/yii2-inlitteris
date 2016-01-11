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
use yii\data\ActiveDataProvider;
use jobrunner\inlitteris\models\Reference;
use jobrunner\inlitteris\api\Citation\Author;
use jobrunner\inlitteris\api\Citation\Mapper\CiteProcMapper;

/**
 * Bibliography widget
 *
 * @package jobrunner\inlitteris\widgets
 */
class Bibliography extends \yii\base\Widget
{
    /** @var  ActiveDataProvider */
    public $dataProvider;

    /** @var  Reference Optional model for a single bibliography entry */
    public $model;

    public $styleName = 'default';

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

        if ($this->dataProvider == null && $this->model == null) {

            throw new InvalidConfigException('"dataProvider" or just at least a "model" must be set in bibliography widget.');
        }

        if ($this->model != null) {
            $this->dataProvider = new ActiveDataProvider();
            $this->dataProvider->setModels([$this->model]);
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $citeProcessor = Yii::createObject('CiteProcessor');
        $citeProcessor->init($this->csl, $this->locale);

        $references    = [];

        foreach ($this->dataProvider->getModels() as $model) {
            $mapper                 = new CiteProcMapper($model);
            $reference              = $mapper->map();
            $references[$model->id] = $reference;
        }

        return $this->render('bibliography', [
            'widgetId'   => $this->getId(),
            'references' => $references,
            'row'        => function($reference, $mode) use ($citeProcessor) {
                return $citeProcessor->render($reference, $mode);
            }
        ]);
   }
}
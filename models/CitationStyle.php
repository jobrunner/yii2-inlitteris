<?php
/*
 * This file is part of the inlitteris project.
 *
 * (c) Jo Brunner <http://github.com/jobrunner/yii2-inlitteris>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace jobrunner\inlitteris\models;

use Yii;
use yii\base\Model;

/**
 * Class CitationStyle
 *
 * @package jobrunner\inlitteris\models
 */
class CitationStyle extends Model
{
    public $citationStyle;


    protected $defaultStyles = [
        'apa-annotated-bibliography',
        'zootaxa',
        'zoological-journal-of-the-linnean-society',
        'bibtex',
        'nature',
        'systematic-biology',
        'annalen-des-naturhistorischen-museums-in-wien',
        'din-1505-2',
        "entomological-society-of-america",
        "invertebrate-biology",
        "iso690-author-date-en",
    ];


    public function _construct($config)
    {
        $this->citationStyle = 'apa-annotated-bibliography';
    }

    public function getAvailabels()
    {

    }

    public function getEnabled()
    {
        return $this->defaultStyles;
    }


    /**
     * Returns localized key/value array of visible reference types
     *
     * @return array
     */
    public function kvListOfVisible()
    {
        $models = ReferenceType::find()
            ->select(['id', 'typeName'])
            ->where('visible = 1')
            ->all();

        $typeList = [];
        foreach ($models as $model) {
            $typeList[$model->id] = Yii::t('inlitteris', $model->typeName);
        }

        return $typeList;
    }
}
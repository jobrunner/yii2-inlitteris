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
// If you decide to use citeproc-php, comment this out. Its optional.
//        'apa-annotated-bibliography' => 'apa-annotated-bibliography',
//        'zootaxa' => 'zootaxa',
//        'zoological-journal-of-the-linnean-society' => 'zoological-journal-of-the-linnean-society',
//        'bibtex' => 'bibtex',
//        'nature' => 'nature',
//        'systematic-biology' => 'systematic-biology',
//        'annalen-des-naturhistorischen-museums-in-wien' => 'annalen-des-naturhistorischen-museums-in-wien',
//        'din-1505-2' => 'din-1505-2',
//        'entomological-society-of-america' => 'entomological-society-of-america',
//        'invertebrate-biology' => 'invertebrate-biology',
//        'iso690-author-date-en' => 'iso690-author-date-en',
    ];


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['citationStyle'], 'required'],
            [['citationStyle'], 'string'],
        ];
    }


    public function kvAvailabels()
    {
        // without citeproc-php only default is available
    }


    /**
     * Returns key/value array of enabled citation styles when citeproc-php is in use.
     * Very bad idea.
     *
     * @return array
     */
    public function kvEnabled()
    {
        // without citeproc-php only default is available
        // It's a hack, but here a selection of styles important for my personal purpose...
        return $this->defaultStyles;
    }
}
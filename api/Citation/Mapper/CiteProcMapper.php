<?php
/*
 * This file is part of the inlitteris project.
 *
 * (c) Jo Brunner <http://github.com/jobrunner/yii2-inlitteris>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace jobrunner\inlitteris\api\Citation\Mapper;

use yii\base\Model;
use jobrunner\inlitteris\api\Citation\Author;

/**
 * Class CiteProcMapper
 *
 * @package jobrunner\inlitteris\api\Mapper
 */
class CiteProcMapper
{
    protected $_model;


    public function __construct(Model $model)
    {
        $this->_model = $model;
    }


    public function map()
    {
        switch ($this->_model->referenceTypeId) {
            case 0:
                return $this->mapArticleJournal();
            case 1:
                return $this->mapBook();
            case 7:
                return $this->mapBookSection();
            case 9:
                return $this->mapEditedBook();
            default:
                return (object)[];
        }
    }


    public function mapBook()
    {
        $reference                  = (object)[];

        $reference->{'type'}        = 'book';

        $reference->{'author'}      = [];

        $authorsStrings = explode("\n", $this->_model->authors);
        foreach ($authorsStrings as $authorString) {
            $author = Author::initWithString($authorString);
            if (!isset($reference->{'author'})) {
                $reference->{'author'} = [];
            }
            $reference->{'author'}[] = (object)[
                'family' => $author->familyName,
                'given'  => $author->givenName
            ];
        }

        // Book can be also an edited Book
        $reference->{'editor'}  = [];
        $editorStrings = explode("\n", $this->_model->secondaryAuthors);
        foreach ($editorStrings as $authorString) {
            $author = Author::initWithString($authorString);
            if (!isset($reference->{'editor'})) {
                $reference->{'editor'} = [];
            }
            $reference->{'editor'}[] = (object)[
                'family' => $author->familyName,
                'given'  => $author->givenName
            ];
        }



        // hier fehlt noch die einiges!!!



        $reference->{'title'}           = $this->_model->title;
        $reference->{'publisher'}       = $this->_model->publisher;
        $reference->{'publisher-place'} = $this->_model->place;
        $reference->{'number-of-pages'} = $this->_model->pages;

        $reference->{'issued'} = (object)[
            "date-parts" => [[$this->_model->year]],
            "literal"    => $this->_model->year
        ];


        return $reference;
    }


    public function mapEditedBook()
    {
        return $this->mapBook();
    }


    public function mapBookSection()
    {
        $reference                      = (object)[];
        $reference->{'type'}            = 'chapter';

        $authorsStrings                 = explode("\n", $this->_model->authors);
        foreach ($authorsStrings as $authorString) {
            $author = Author::initWithString($authorString);
            if (!isset($reference->{'author'})) {
                $reference->{'author'} = [];
            }
            $reference->{'author'}[] = (object)[
                'family' => $author->familyName,
                'given'  => $author->givenName
            ];
        }

        $editorStrings                  = explode("\n", $this->_model->secondaryAuthors);
        foreach ($editorStrings as $authorString) {
            $author = Author::initWithString($authorString);
            if (!isset($reference->{'editor'})) {
                $reference->{'editor'} = [];
            }
            $reference->{'editor'}[] = (object)[
                'family' => $author->familyName,
                'given'  => $author->givenName
            ];
        }

        $reference->{'title'}           = $this->_model->title;
        $reference->{'container-title'} = $this->_model->secondaryTitle;
        $reference->{'publisher'}       = $this->_model->publisher;
        $reference->{'publisher-place'} = $this->_model->place;
        $reference->{'volume'}          = $this->_model->volume;
        $reference->{'page'}            = $this->_model->section;
        $reference->{'number-of-pages'} = $this->_model->pages;
        $reference->{'page-first'}      = $this->_model->section;
        $reference->{'ISBN'}            = $this->_model->isbn;
        $reference->{'id'}              = $this->_model->id;
        $reference->{'issued'}          = (object)[
            "date-parts" => [[$this->_model->year]],
            "literal"    => $this->_model->year
        ];

        return $reference;
    }


    public function mapArticleJournal()
    {
        $reference      = (object)[];

        $authorsStrings = explode("\n", $this->_model->authors);

        foreach ($authorsStrings as $authorString) {
            $author = Author::initWithString($authorString);

            if (!isset($reference->{'author'})) {
                $reference->{'author'} = [];
            }

            $reference->{'author'}[]    = (object)[
                'family' => $author->familyName,
                'given'  => $author->givenName
            ];
        }

        $reference->{'id'}              = $this->_model->id;
        $reference->{'type'}            = 'article-journal';
        $reference->{'title'}           = $this->_model->title;
        $reference->{'container-title'} = $this->_model->secondaryTitle;
        $reference->{'publisher'}       = $this->_model->publisher;
        $reference->{'publisher-place'} = $this->_model->place;

        // locater is not implemented in citeproc-php...
        $reference->{'locater'}         = 'page';

        $reference->{'volume'}          = $this->_model->volume;
        $reference->{'issue'}           = $this->_model->number;
        $reference->{'page'}            = $this->_model->pages;
        $reference->{'number_of_pages'} = $this->_model->pages;
        $reference->{'page-first'}      = $this->_model->section;
        $reference->{'ISSN'}            = $this->_model->isbn;

        $reference->{'issued'} = (object)[
            "date-parts" => [[$this->_model->year]],
            "literal"    => $this->_model->year
        ];

        return $reference;
    }
}
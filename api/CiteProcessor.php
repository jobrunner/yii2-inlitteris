<?php
namespace jobrunner\inlitteris\api;

//use jobrunner\inlitteris\helpers\Html;
use jobrunner\inlitteris\api\Citation\Author;
use jobrunner\inlitteris\api\Citation\Formatter\AuthorFormatter;

use jobrunner\inlitteris\api\Citation\Renderer\Bibliography;
use jobrunner\inlitteris\api\Citation\Renderer\Bibliography\Book;

/**
 * Simple default CiteProcessor
 * @todo Changes to make sources testable and refactorable.
 *
 * @package jobrunner\inlitteris\api\CiteProcessor
 */
class CiteProcessor
{
    /**
     * Citeproc-php compat mehtod
     *
     * @param null   $csl
     * @param string $lang
     */
    public function init($csl = null, $lang = 'en-US')
    {
    }


    /**
     * Renders citation or bibliography
     *
     * @param      $reference
     * @param null $mode    Optional. Rendering mode 'citation' or 'bibliography'. Defaults to bibliography.
     *
     * @return string
     */
    public function render($reference, $mode = null)
    {
        switch ($mode) {
            case 'citation':
                return $this->renderCitation($reference);
//                return (new CitationRenderer($reference))->render($reference);

            case 'bibliography':
            default:
                return (new Bibliography($reference))->render();
        }
    }


    public function renderCitation($reference)
    {
        $format    = AuthorFormatter::SEQ_FAMILY |
                     AuthorFormatter::CAPITALIZATION_NORMAL;

        $formatter = new AuthorFormatter($format);

        $authors   = $reference->{'author'};

        $author    = new Author([
            'givenName'  => $authors[0]->given,
            'familyName' => $authors[0]->family
        ]);

        $output = $author->format($formatter);

        if (count($authors) > 1) {
            // First author et. al.
            $output = $output . ' et. al.' . $this->renderYear($reference);
        } elseif (count($authors) > 0) {
            // Author as is
        } else {
            $output = 'Anonymous';
        }

        $output = "(" . $output . ", " . $this->renderYear($reference) . ")";

        return $output;
//
//        return Html::encode($output);
    }


    public function renderBibliography($reference)
    {
        switch ($reference->type) {
            case 'chapter':
                return
                    '<b>' .
                    $this->renderAuthor($reference->{'author'})          .
                    $this->renderIssued($reference->{'issued'})          .
                    '</b>' .
                    $this->renderTitle($reference->{'title'})   . ', '   .
                    $this->renderPageLocator($reference->{'page'}) .
                    '– In: ' .
                    $this->renderEditor($reference->{'editor'}) .
                    $this->renderContainerTitle($reference->{'container-title'}) .
                    $this->renderVolume($reference) .
                    $this->renderPlace($reference) .
                    $this->renderPublisher($reference) .
                    $this->renderNumberOfPages($reference->{'number-of-pages'}) .
                    '<br>';
            case 'book':

//                echo "<pre>";
//                print_r($reference);
//                exit;

//                return 'book bibliography not yet implemented<br/>';
                return ''
                    . '<b>'
                    . $this->renderAuthor($reference)
                    . '('
                    . $this->renderIssued($reference)
                    . ')'
                    . '</b>'
                    . ': '
                    . $this->renderTitle($reference)
                    . ', '

//                    $this->renderPageLocator($reference->{'page'}) .
//                    '– In: ' .
//                    $this->renderEditor($reference->{'editor'}) .
//                    $this->renderContainerTitle($reference->{'container-title'}) .
                    . $this->renderVolume($reference) .
                    $this->renderPlace($reference) .
                    $this->renderPublisher($reference) .
                    $this->renderNumberOfPages($reference->{'number-of-pages'}) .
                    '<br>';

            case 'article-journal':
                return
                    '<b>' .
                    $this->renderAuthor($reference->{'author'})          .
                    $this->renderIssued($reference)          .
                    '</b>' .
                    $this->renderTitle($reference->{'title'})   . '. '   .
                    $this->renderContainerTitle($reference->{'container-title'}) .
                    $this->renderJournalVolume($reference->{'volume'}) .
                    $this->renderJournalIssue($reference->{'issue'}) .
                    $reference->{'page'} . '.' .
                    '<br>';
        }


        return "<li>Reference ({$reference->type})</li>";
    }


    /**
     * Returns the year of publication or 's. a.' (sine anno = without year)
     *
     * @param $reference
     *
     * @return string
     */
    public function renderYear($reference)
    {
        $issued = empty($reference->{'issued'}) ? null : $reference->{'issued'};

        if (empty($issued->{'date-parts'})) {

            return 's. a.';
        }

        $copy = $issued->{'date-parts'};

        return array_shift($copy)[0];
    }


    public function renderJournalVolume($volume)
    {
        if (!empty($volume)) {


            return '<b>' . Html::encode($volume) . '</b> ';
        }

        return '';
    }


    public function renderJournalIssue($issue)
    {
        if (!empty($issue)) {

            return '(' . Html::encode($issue) . ') ';
        }

        return '';
    }


    /**
     * Renders Authors for Bibliography
     *
     * @param $reference
     *
     * @return string
     */
    public function renderAuthor($reference)
    {
        $authors   = empty($reference->{'author'}) ? [] : $reference->{'author'};

        if (empty($authors)) {

            return 'S.a.';
        }

        $output    = [];
        $separator = ' & ';
        $format    = AuthorFormatter::SEQ_FAMILY_COMMA_GIVEN |
                     AuthorFormatter::GIVEN_NAME_SECOND |
                     AuthorFormatter::GIVEN_NAME_ABBR_ALL |
                     AuthorFormatter::ALTERNATIVE_NAMES_SUPPRESS |
                     AuthorFormatter::CAPITALIZATION_NORMAL;

        $formatter = new AuthorFormatter($format);

        foreach ($authors as $a) {
            $author = new Author([
                'givenName'  => $a->given,
                'familyName' => $a->family
            ]);
            $output[] = $author->format($formatter);
        }

        return implode($separator, $output);
    }


    public function renderIssued($reference)
    {
//        $issued = empty($reference->{'issued'}) ? 's. a.' : $reference->{'issued'};

        return " (" . $this->renderYear($reference) . "): ";

//        return " (" . Html::encode($this->renderYear($reference)) . "): ";
    }


    /**
     * Returns title or s.t. (sensu titulo = without title)
     *
     * @param $reference
     *
     * @return mixed|string
     */
    public function renderTitle($reference)
    {
        $title = empty($reference->{'title'}) ? 'S.t.' : rtrim($reference->{'title'}, ',. ');

        return $title;
//        return Html::encodeWithoutEm($title);
    }


    public function renderContainerTitle($reference)
    {
        $title = empty($reference->{'title'}) ? '' : rtrim($reference->{'title'}, ',. ');

        return $title . '. ';

//        return Html::encodeWithoutEm($title . '. ');
    }


    /**
     * Renders the Editor(s) of an Book
     *
     * @param $reference
     *
     * @return string
     */
    public function renderEditor($reference)
    {
        $editor = empty($reference->{'editor'}) ? null : $this->renderAuthor($reference->{'editor'}); //  . ' (Eds.): ';

        if (empty($editor)) {

            return 'S.ed.: ';
        }

        if (count($reference->{'editor'}) > 1) {
            $eds = ' (Eds.): ';
        } else {
            $eds = ' (Ed.): ';
        }

        return $this->renderAuthor($reference->{'editor'}) . $eds;
    }


    /**
     * Renders the Volume of a Book
     *
     * @param $reference
     *
     * @return string
     */
    public function renderVolume($reference)
    {
        if (!empty($reference->{'volume'})) {

            return 'Vol. ' . rtrim($reference->{'volume'}, '., ') . '. ';
//            return 'Vol. ' . Html::encode($reference->{'volume'}) . '. ';
        }

        return '';
    }


    public function renderPageLocator($page)
    {
        if (!empty($page)) {

            return 'p. ' . Html::encode($page) . '. ';
        }

        return '';
    }


    public function renderPlace($reference)
    {
        $place = empty($reference->{'publisher-place'}) ? null : $reference->{'publisher-place'};

        if (!empty($place)) {

//            return Html::encode(rtrim($place, '. ') . '. ');
            return rtrim($place, '. ') . '. ';
        }

        // sine loco (= _without place_ of publication)
        return 's. l. ';
    }


    public function renderPublisher($reference)
    {
        $publisher = empty($reference->{'publisher'}) ? null : $reference->{'publisher'};

        if (!empty($publisher)) {

            return rtrim($publisher, '. ') . '. ';
        }

        // sine nomine (= _without name_ of publisher)
        return 's. n. ';
    }


    public function renderNumberOfPages($numberOfPages)
    {
        if (!empty($numberOfPages)) {

            return rtrim($numberOfPages, '.pf ') . ' pp. ';
//            return Html::encode(rtrim($numberOfPages, '.pf ') . ' pp. ');
        }

        return '';
    }
}
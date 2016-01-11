<?php
namespace jobrunner\inlitteris\api;

use jobrunner\inlitteris\helpers\Html;
use jobrunner\inlitteris\api\Citation\Author;
use jobrunner\inlitteris\api\Citation\Formatter\AuthorFormatter;

/**
 * Simple default CiteProcessor
 * @todo Changes to make sources testable and refactorable.
 *
 * @package jobrunner\inlitteris\api\CiteProcessor
 */
class CiteProcessor
{
    public function init($csl = null, $lang = 'en-US')
    {
    }


    public function render($reference, $mode = null)
    {
        switch ($mode) {
            case 'citation':
                return $this->renderCitation($reference);

            case 'bibliography':
            default:
                return $this->renderBibliography($reference);
        }
    }


    public function renderCitation($reference)
    {
        return "not implemented";
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
                    $this->renderVolume($reference->{'volume'}) .
                    $this->renderPlace($reference->{'publisher-place'}) .
                    $this->renderPublisher($reference->{'publisher'}) .
                    $this->renderNumberOfPages($reference->{'number-of-pages'}) .
                    '<br>';
            case 'book':
                return 'not implemented yet<br/>';

            case 'article-journal':
                return
                    '<b>' .
                    $this->renderAuthor($reference->{'author'})          .
                    $this->renderIssued($reference->{'issued'})          .
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


    public function renderAuthor(array $authors)
    {
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

        return Html::encode(implode($separator, $output));
    }


    public function renderIssued($issued)
    {
        return " (" . Html::encode($issued->literal) . "): ";
    }


    public function renderTitle($title)
    {
        return Html::encodeWithoutEm(rtrim($title, ',. '));
    }


    public function renderContainerTitle($title)
    {
        return $this->renderTitle($title) . '. ';
    }


    public function renderEditor(array $editors)
    {
        return $this->renderAuthor($editors) . ' (Eds.): ';
    }


    public function renderVolume($volume)
    {
        if (!empty($volume)) {

            return 'Vol. ' . Html::encode($volume) . '. ';
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


    public function renderPlace($place)
    {
        if (!empty($place)) {

            return Html::encode(rtrim($place, '. ') . '. ');
        }

        return '';
    }


    public function renderPublisher($publisher)
    {
        if (!empty($publisher)) {

            return Html::encode(rtrim($publisher, '. ') . '. ');
        }

        return '';
    }


    public function renderNumberOfPages($numberOfPages)
    {
        if (!empty($numberOfPages)) {

            return Html::encode(rtrim($numberOfPages, '.pf ') . ' pp. ');
        }

        return '';
    }
}
<?php
/*
 * This file is part of the inlitteris project.
 *
 * (c) Jo Brunner <http://github.com/jobrunner/yii2-inlitteris>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace jobrunner\inlitteris\api\Citation\Renderer;

//use jobrunner\inlitteris\api\Citation\Author;
//use jobrunner\inlitteris\api\Citation\Formatter\AuthorFormatter;
use jobrunner\inlitteris\api\Citation\Renderer\Bibliography\Book;
use jobrunner\inlitteris\api\Citation\Renderer\Bibliography\Chapter;
//use jobrunner\inlitteris\api\Citation\Renderer\Bibliography\Book\Journal;


// im Grunde ist Bibliography eine Factory
class Bibliography
{
    protected $renderer = null;

    public function __construct($reference)
    {
//        if ($renderer != null) {
//            $this->renderer = $renderer;
//        }
//        if (empty($reference->type)) {
//            $this->renderer = new Journal($reference);
//            return;
//        }

        switch ($reference->type) {
            case 'book':
                $this->renderer = new Book($reference);
                break;

            case 'chapter':
                $this->renderer = new Chapter($reference);
                break;

            case 'article-journal':
            default:
//                $this->renderer = new Journal($reference);
                break;
        }
    }

    /**
     * Renders a bibliographic entry
     *
     * @param $reference
     *
     * @return string
     */
    public function render()
    {
        return $this->renderer->render();
    }
}
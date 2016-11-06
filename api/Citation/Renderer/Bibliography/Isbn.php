<?php
/*
 * This file is part of the inlitteris project.
 *
 * (c) Jo Brunner <http://github.com/jobrunner/yii2-inlitteris>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace jobrunner\inlitteris\api\Citation\Renderer\Bibliography;

use jobrunner\inlitteris\api\Citation\Renderer\ComponentTrait;

class Isbn
{
    use ComponentTrait;

    /**
     * Returns the ISBN component: either "ISBN: <isbn>. " or ""
     *
     * @param $reference
     *
     * @return string
     */
    function render()
    {
        $isbn = empty($this->reference->{'ISBN'}) ? '' : rtrim($this->reference->{'ISBN'}, ',. ');

        if (empty($isbn)) {

            return '';
        }

        // How to address:
        // - formatting of isbn
        // - print-isbn
        // - online-isbn
        // - isbn-10 vs. isbn-13

        return 'ISBN: ' . $isbn . '. ';
    }
}

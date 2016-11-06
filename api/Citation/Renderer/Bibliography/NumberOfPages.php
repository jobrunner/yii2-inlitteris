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

class NumberOfPages
{
    use ComponentTrait;

    /**
     * Returns the title component: either year or 's.a.' (sine anno = without year)
     *
     * @param $reference
     *
     * @return string
     */
    function render()
    {
        $pages = empty($this->reference->{'number-of-pages'}) ? '' : rtrim($this->reference->{'number-of-pages'}, '.,pf ');

        if (empty($pages)) {

            return '';
        }

        return $pages . ' pp.';

    }
}

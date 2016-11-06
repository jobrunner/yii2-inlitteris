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

class Publisher
{
    use ComponentTrait;

    /**
     * Returns the title component: either publisher or 's.n.' (sine nomine = without name of publisher)
     *
     * @param $reference
     *
     * @return string
     */
    function render()
    {
        $publisher = empty($this->reference->{'publisher'}) ? 's.n.' : rtrim($this->reference->{'publisher'}, ',. ');

        return $publisher . ', ';
    }
}

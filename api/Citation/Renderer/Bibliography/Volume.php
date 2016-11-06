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

class Volume
{
    use ComponentTrait;

    /**
     * Returns the volume component: either "Vol. <number>. " or "" (sine anno = without year)
     *
     * @param $reference
     *
     * @return string
     */
    function render()
    {
        $volume = empty($this->reference->{'volume'}) ? '' : rtrim($this->reference->{'volume'}, ',. ');

        if (empty($volume)) {

            return '';
        }

        return 'Vol. ' . $volume . '. ';
    }
}

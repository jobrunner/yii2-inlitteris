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

class Issued
{
    use ComponentTrait;

    /**
     * Returns the year component: either year or 's.a.' (sine anno = without year)
     *
     * @param $reference
     *
     * @return string
     */
    function render()
    {
        $issued = empty($this->reference->{'issued'}) ? null : $this->reference->{'issued'};

        if (empty($issued->{'date-parts'})) {

            return 's. a.';
        }

        $copy = $issued->{'date-parts'};

        return array_shift($copy)[0];
    }
}

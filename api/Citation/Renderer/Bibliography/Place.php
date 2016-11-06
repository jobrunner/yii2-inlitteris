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

class Place
{
    use ComponentTrait;

    /**
     * Returns the title component: either place or 'S.l.' (sine loco = without place)
     *
     * @param $reference
     *
     * @return string
     */
    function render()
    {
        $place = empty($this->reference->{'publisher-place'}) ? 'S.l.' : rtrim($this->reference->{'publisher-place'}, ',. ');

        return $place. ': ';
    }
}

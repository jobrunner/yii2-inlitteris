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

class ContainerTitle
{
    use ComponentTrait;

    /**
     * Returns the container title component
     *
     * @param $reference
     *
     * @return string
     */
    function render()
    {
        $title = empty($this->reference->{'container-title'}) ? 'S.t' : rtrim($this->reference->{'container-title'}, ',. ');

        return $title . '. ';
    }
}

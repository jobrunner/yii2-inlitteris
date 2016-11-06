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

class Title
{
    use ComponentTrait;

    /**
     * Returns the title component: either year or 's.t.' (sine titulo = without title)
     *
     * @param $reference
     *
     * @return string
     */
    function render()
    {
        $title = empty($this->reference->{'title'}) ? 'S.t' : rtrim($this->reference->{'title'}, ',. ');

        return $title . '. ';
    }
}

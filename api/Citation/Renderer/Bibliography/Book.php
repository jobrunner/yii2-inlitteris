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

use Yii;
use jobrunner\inlitteris\api\Citation\Renderer\ComponentTrait;

class Book
{
    use ComponentTrait;

//    public function __construct($authorRenderer, $issuedRenderer, $titleRenderer)

    /**
     * Renders a book reference
     *
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    function render()
    {

        // Genau hier KEINEN SeriveLocator verwenden!
        // DI ja.
        return ''
        . '<b>'
        . Yii::createObject('jobrunner\inlitteris\api\Citation\Renderer\Bibliography\Author', [
            $this->reference]
        )->render()

        . ' ('
        . Yii::createObject('jobrunner\inlitteris\api\Citation\Renderer\Bibliography\Issued', [
            $this->reference]
        )->render()
        . '): </b>'

        . Yii::createObject('jobrunner\inlitteris\api\Citation\Renderer\Bibliography\Title', [
            $this->reference]
        )->render()

        . Yii::createObject('jobrunner\inlitteris\api\Citation\Renderer\Bibliography\Volume', [
            $this->reference]
        )->render()

        . Yii::createObject('jobrunner\inlitteris\api\Citation\Renderer\Bibliography\Place', [
            $this->reference]
        )->render()

        . Yii::createObject('jobrunner\inlitteris\api\Citation\Renderer\Bibliography\Publisher', [
            $this->reference]
        )->render()

        . Yii::createObject('jobrunner\inlitteris\api\Citation\Renderer\Bibliography\NumberOfPages', [
            $this->reference]
        )->render();
    }
}
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

class Journal
{
    use ComponentTrait;


    /**
     * Renders a book reference
     *
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    function render()
    {
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

//        $this->renderContainerTitle($reference->{'container-title'}) .


        . Yii::createObject('jobrunner\inlitteris\api\Citation\Renderer\Bibliography\ContainerTitle', [
            $this->reference]
        )->render()


//        . '– In: '
//
//        . Yii::createObject('jobrunner\inlitteris\api\Citation\Renderer\Bibliography\Editor', [
//            $this->reference]
//        )->render()


        . Yii::createObject('jobrunner\inlitteris\api\Citation\Renderer\Bibliography\Volume', [
            $this->reference]
        )->render()

//        $this->renderJournalIssue($reference->{'issue'}) .


//        . Yii::createObject('jobrunner\inlitteris\api\Citation\Renderer\Bibliography\Place', [
//            $this->reference]
//        )->render()
//
//        . Yii::createObject('jobrunner\inlitteris\api\Citation\Renderer\Bibliography\Publisher', [
//            $this->reference]
//        )->render()

        . Yii::createObject('jobrunner\inlitteris\api\Citation\Renderer\Bibliography\NumberOfPages', [
            $this->reference]
        )->render();

//        $reference->{'page'} . '.' .

    }
}
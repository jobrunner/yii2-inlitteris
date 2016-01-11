<?php
/*
 * This file is part of the inlitteris project.
 *
 * (c) Jo Brunner <http://github.com/jobrunner/yii2-inlitteris>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use yii\helpers\Html;
use jobrunner\inlitteris\widgets\Citation;

/* @var $this yii\web\View */
/* @var $model jobrunner\inlitteris\models\Reference */
/* @var $referenceTypeModel jobrunner\inlitteris\models\ReferenceType */


$citation = Citation::widget([
    'model'  => $model,
    'csl'    => \AcademicPuma\CiteProc\CiteProc::loadStyleSheet('apa-annotated-bibliography'),
    'locale' => 'en-US'
]);

$breadcrumbCitation = strip_tags($citation);
$breadcrumbCitation = preg_replace('/\R/u', '', $breadcrumbCitation);
$breadcrumbCitation = trim($breadcrumbCitation, '()');

$this->title = Yii::t('inlitteris', 'Update {modelClass}: ', [
    'modelClass' => 'Reference',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('inlitteris', 'References'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $breadcrumbCitation, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('inlitteris', 'Update');
?>
<div class="reference-update">

    <h1><?= Html::encode($breadcrumbCitation) ?></h1>

    <?= $this->render('_form', [
        'model'              => $model,
        'referenceTypeModel' => $referenceTypeModel
    ]) ?>

</div>

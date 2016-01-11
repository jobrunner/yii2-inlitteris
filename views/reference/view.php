<?php
/*
 * This file is part of the inlitteris project.
 *
 * (c) Jo Brunner <http://github.com/jobrunner/yii2-inlitteris>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use yii\widgets\DetailView;
use jobrunner\inlitteris\helpers\Html;
use jobrunner\inlitteris\widgets\Citation;
use jobrunner\inlitteris\widgets\Bibliography;

/* @var $this yii\web\View */
/* @var $model jobrunner\inlitteris\models\Reference */

$citation = Citation::widget([
    'model'  => $model,
    'csl'    => \AcademicPuma\CiteProc\CiteProc::loadStyleSheet('apa-annotated-bibliography'),
    'locale' => 'en-US'
]);

$breadcrumbCitation = strip_tags($citation);
$breadcrumbCitation = preg_replace('/\R/u', '', $breadcrumbCitation);
$breadcrumbCitation = trim($breadcrumbCitation, '()');

$this->params['breadcrumbs'][] = ['label' => Yii::t('inlitteris', 'References'), 'url' => ['index']];
$this->params['breadcrumbs'][] = Html::encode($breadcrumbCitation);
?>
<div class="reference-view">

    <h2><?= Html::encode($breadcrumbCitation) ?></h2>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id:ntext',
            [
                'label'  => 'Citation',
                'format' => 'html',
                'value'  => $citation
            ],
            [
                'label'  => 'Bibliography',
                'format' => 'html',
                'value'  => Bibliography::widget([
                    'model'  => $model,
                    'csl'    => \AcademicPuma\CiteProc\CiteProc::loadStyleSheet('apa-annotated-bibliography'),
                    'locale' => 'en-US'
                ])
            ],
            'referenceType.typeName:ntext',
            'authors:ntext',
            'title:html',
            'secondaryTitle:ntext',
            'secondaryAuthors:ntext',
            'tertiaryTitle:ntext',
            'tertiaryAuthors:ntext',
            'year:ntext',
            'volume:ntext',
            'number:ntext',
            'pages:ntext',
            'section:ntext',
            'edition:ntext',
            'place:ntext',
            'publisher:ntext',
            'isbn:ntext',
        ],
    ]) ?>
    <p style="text-align: center">
        <?= Html::a(Yii::t('inlitteris', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('inlitteris', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('inlitteris', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

</div>

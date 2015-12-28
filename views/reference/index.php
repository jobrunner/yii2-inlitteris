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
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel jobrunner\inlitteris\models\ReferenceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('inlitteris', 'References');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reference-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('inlitteris', 'Create Reference'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // hier Author.


//            'id',
//            'referenceTypeId',
//            'authors',
//            [
//                'class'     => 'yii\grid\DataColumn',
//                'attribute' => 'authors',
//                'format'    => 'raw',
//                'value'     => function ($data) {
//
//                    return "entweder oder";
//
//                    return Html::a($data->sampleNumber,
//                                   \yii\helpers\Url::toRoute([
//                                       'sample/view',
//                                       'id' => $data->id
//                                   ]));
//                }
//            ],
            'authors:ntext',
            'year:ntext',
            'title:ntext',
            'secondaryTitle:ntext',
            // 'secondaryAuthors:ntext',
            // 'tertiaryTitle:ntext',
            // 'tertiaryAuthors:ntext',
            // 'year:ntext',
            // 'volume:ntext',
            // 'number:ntext',
            // 'pages:ntext',
            // 'section:ntext',
            // 'edition:ntext',
            // 'place:ntext',
            // 'publisher:ntext',
            // 'isbn:ntext',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

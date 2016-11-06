<?php
/*
 * This file is part of the inlitteris project.
 *
 * (c) Jo Brunner <http://github.com/jobrunner/yii2-inlitteris>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use jobrunner\inlitteris\helpers\Html;
use yii\grid\GridView;
use jobrunner\inlitteris\widgets\Bibliography;

/* @var $this yii\web\View */
/* @var $searchModel jobrunner\inlitteris\models\ReferenceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('inlitteris', 'References');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reference-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('inlitteris', 'Create Reference'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'authors:ntext',
            'year:ntext',
            [
                'attribute' => 'title',
                'format'    => 'raw',
                'value'     => function ($data) {
                    return Html::encodeWithoutEm($data->title);
                }
            ],
            [
                'attribute' => 'secondaryTitle',
                'format'    => 'raw',
                'value'     => function ($data) {
                    return Html::encodeWithoutEm($data->secondaryTitle);
                }
            ],
            // 'secondaryTitle:ntext',
            // 'secondaryAuthors:ntext',
            // 'tertiaryTitle:ntext',
            // 'tertiaryAuthors:ntext',
            // 'year:ntext',
             'volume:ntext',
             'number:ntext',
            // 'pages:ntext',
            // 'section:ntext',
            // 'edition:ntext',
            // 'place:ntext',
            // 'publisher:ntext',
             'isbn:ntext',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>

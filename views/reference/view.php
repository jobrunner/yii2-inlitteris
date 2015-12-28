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
use yii\widgets\DetailView;
use jobrunner\inlitteris\widgets\Cite;

/* @var $this yii\web\View */
/* @var $model jobrunner\inlitteris\models\Reference */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('inlitteris', 'References'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reference-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('inlitteris', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('inlitteris', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('inlitteris', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= Cite::widget(['model' => $model])?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'referenceTypeId',
            'authors:ntext',
            'title:ntext',
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

</div>

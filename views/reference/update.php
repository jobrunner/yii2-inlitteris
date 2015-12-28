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

/* @var $this yii\web\View */
/* @var $model jobrunner\inlitteris\models\Reference */

$this->title = Yii::t('inlitteris', 'Update {modelClass}: ', [
    'modelClass' => 'Reference',
]) . ' ' . $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('inlitteris', 'References'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('inlitteris', 'Update');
?>
<div class="reference-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

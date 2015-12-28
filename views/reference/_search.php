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
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model jobrunner\inlitteris\models\ReferenceSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reference-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'referenceTypeId') ?>

    <?= $form->field($model, 'authors') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'secondaryTitle') ?>

    <?php // echo $form->field($model, 'secondaryAuthors') ?>

    <?php // echo $form->field($model, 'tertiaryTitle') ?>

    <?php // echo $form->field($model, 'tertiaryAuthors') ?>

    <?php // echo $form->field($model, 'year') ?>

    <?php // echo $form->field($model, 'volume') ?>

    <?php // echo $form->field($model, 'number') ?>

    <?php // echo $form->field($model, 'pages') ?>

    <?php // echo $form->field($model, 'section') ?>

    <?php // echo $form->field($model, 'edition') ?>

    <?php // echo $form->field($model, 'place') ?>

    <?php // echo $form->field($model, 'publisher') ?>

    <?php // echo $form->field($model, 'isbn') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('inlitteris', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('inlitteris', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

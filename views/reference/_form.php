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
/* @var $model jobrunner\inlitteris\models\Reference */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reference-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'authors')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'secondaryTitle')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'secondaryAuthors')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tertiaryTitle')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'tertiaryAuthors')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'year')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'volume')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'number')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'pages')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'section')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'edition')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'place')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'publisher')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'isbn')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('inlitteris', 'Create') : Yii::t('inlitteris', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

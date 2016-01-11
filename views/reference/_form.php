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
/* @var $availableReferenceTypes array */
/* @var $referenceTypeModel jobrunner\inlitteris\models\ReferenceType */
?>

<div class="reference-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'referenceTypeId')->dropDownList(
        $referenceTypeModel->kvListOfVisible(),
        ['onchange' => 'this.form.submit()'])
    ?>

    <?= $form->field($model, 'formerReferenceTypeId')->hiddenInput(['value' => $model->referenceTypeId])->label(false) ?>

    <?php if (false == $model->isNewRecord): ?>
    <?= $form->field($model, 'id')->textInput([
            'readonly' => "readonly"
        ])->label('Id') ?>
    <?php endif ?>
    <?php
        foreach ($model->kvFieldList() as $field => $alias) {
            $rows = substr_count($model->{$field}, "\n") + 1;
            echo $form->field($model, $field, [
                'template' => "<span class='reference-input-help' data-toggle='tooltip' data-placement='right' title='" . Yii::t('inlitteris', "{$model->referenceTypeId}-{$field}-help") . "'>"
                    . "{label}\n"
                    . "</span>\n{input}\n{hint}\n{error}"
            ])->textarea([
                'rows' => $rows,
            ])->label($alias);
        }
    ?>

    <div class="form-group" style="text-align:center">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('inlitteris', 'Create') : Yii::t('inlitteris', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <?php
    $js = <<< 'SCRIPT'
    /* To initialize BS3 tooltips set this below */
    $(function () {
        $("[data-toggle='tooltip']").tooltip();
    });;
    /* To initialize BS3 popovers set this below */
    $(function () {
        $("[data-toggle='popover']").popover();
    });
SCRIPT;
    // Register tooltip/popover initialization javascript
    $this->registerJs($js);
    ?>
</div>

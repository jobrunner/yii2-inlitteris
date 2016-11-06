<?php
/*
 * This file is part of the inlitteris project.
 *
 * (c) Jo Brunner <http://github.com/jobrunner/yii2-inlitteris>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use yii\widgets\ActiveForm;
use jobrunner\inlitteris\helpers\Html;
use jobrunner\inlitteris\widgets\Bibliography;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel jobrunner\inlitteris\models\ReferenceSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $model jobrunner\inlitteris\models\CitationStyle */

$this->title = Yii::t('inlitteris', 'Bibliography');
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="reference-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>
        <?= Html::a(Yii::t('inlitteris', 'Create Reference'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php $enabledStyles = $model->kvEnabled(); ?>
    <?php if (count($enabledStyles) > 0):?>
        <?php $form = ActiveForm::begin([
            'method' => 'get'
        ]); ?>
        <?= $form->field($model, 'citationStyle')->dropDownList(
            $model->kvEnabled(),
            ['onchange' => 'this.form.submit()']
        )?>
        <?php ActiveForm::end(); ?>
    <?php endif ?>

    <?= Bibliography::widget([
        'dataProvider' => $dataProvider,
        // Because cite proc is optional it's commented out. Here an example for usage:
        // 'csl'          => \AcademicPuma\CiteProc\CiteProc::loadStyleSheet($model->citationStyle),
        // 'locale'       => 'en-US'
    ])?>

</div>

<div id="inlitteris-form-widget-<?= $widgetId ?>">
    <button value="<?= $createUrl ?>" class="reference-opener <?= $buttonClass ?>"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> <?= $buttonText ?></button>
</div>


<?php $this->on(\yii\web\View::EVENT_END_BODY, function () use ($updateUrl) { ?>


    <div class="modal fade" id="label-modal" tabindex="-1" role="dialog" aria-labelledby="label-modal">
        <div class="modal-dialog" role="document">
            <div id="label-modal-content" class="modal-content"/>
        </div>
    </div>


<?php });?>
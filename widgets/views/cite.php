<?php
/*
 * This file is part of the inlitteris project.
 *
 * (c) Jo Brunner <http://github.com/jobrunner/yii2-inlitteris>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/* @var $this yii\web\View */
/* @var $model jobrunner\inlitteris\models\Reference */
/* @var $widgetId */
?>
<div id="inlitteris-referece-widget-<?php echo $widgetId?>">
    <?= $model->authors ?>, <?= $model->year ?> <?= $model->title ?>
</div>


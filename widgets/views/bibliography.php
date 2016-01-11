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
/* @var $widgetId string */
/* @var $references array */
/* @var $row callable */
?>
<div id="inlitteris-bibliography-widget-<?php echo $widgetId?>">
    <?php foreach ($references as $key => $reference):?>
        <?= $row($reference, "bibliography") ?>
    <?php endforeach ?>
</div>

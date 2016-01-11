<?php
/*
 * This file is part of the inlitteris project.
 *
 * (c) Jo Brunner <http://github.com/jobrunner/yii2-inlitteris>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace jobrunner\inlitteris\controllers;

use yii\rest\ActiveController;

/**
 * Class ServiceController
 *
 * @package jobrunner\inlitteris\controllers
 */
class ServiceController extends ActiveController
{
    public $modelClass = 'jobrunner\inlitteris\models\Reference';
}
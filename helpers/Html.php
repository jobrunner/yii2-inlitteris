<?php
/*
 * This file is part of the inlitteris project.
 *
 * (c) Jo Brunner <http://github.com/jobrunner/yii2-inlitteris>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace jobrunner\inlitteris\helpers;

//use \yii\helpers\Html;

/**
 * Class MarkupHtml
 *
 * @package jobrunner\inlitteris\helpers
 */
class Html extends \yii\helpers\Html
{
    /**
     * Hack escaping to allow <em>-Tag
     *
     * @param           $content
     * @param bool|true $doubleEncode
     *
     * @return mixed|string
     */
    public static function encodeWithoutEm($content, $doubleEncode = true)
    {
        $content = str_replace('<em>', '{{em}}', $content);
        $content = str_replace('</em>', '{{/em}}', $content);

        $content = static::encode($content, $doubleEncode);

        $content = str_replace('{{em}}', '<em>', $content);
        $content = str_replace('{{/em}}', '</em>', $content);

        return $content;
    }
}

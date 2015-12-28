<?php
/*
 * This file is part of the inlitteris project.
 *
 * (c) Jo Brunner <http://github.com/jobrunner/yii2-inlitteris>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace jobrunner\inlitteris\api\Citation\Formatter;

use jobrunner\inlitteris\api\Citation\Author;

/**
 * Interface AuthorFormatterInterface
 *
 * @package jobrunner\inlitteris\api\Citation\Formatter
 */
interface AuthorFormatterInterface
{
    public function format(Author $authorToFormat);
}
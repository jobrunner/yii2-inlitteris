<?php
/*
 * This file is part of the inlitteris project.
 *
 * (c) Jo Brunner <http://github.com/jobrunner/yii2-inlitteris>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace jobrunner\inlitteris\api\Citation\Renderer\Bibliography;

use jobrunner\inlitteris\api\Citation\Author as AuthorNormalizer;
use jobrunner\inlitteris\api\Citation\Formatter\AuthorFormatter;
use jobrunner\inlitteris\api\Citation\Renderer\ComponentTrait;

class Author
{
    use ComponentTrait;

    /**
     * Renders author component
     *
     * @return string
     */
    function render()
    {
        $authors   = empty($this->reference->{'author'}) ? [] : $this->reference->{'author'};

        if (empty($authors)) {

            return 'S.a.';
        }

        $output    = [];
        $separator = ' & ';
        $format    = AuthorFormatter::SEQ_FAMILY_COMMA_GIVEN |
                     AuthorFormatter::GIVEN_NAME_SECOND |
                     AuthorFormatter::GIVEN_NAME_ABBR_ALL |
                     AuthorFormatter::ALTERNATIVE_NAMES_SUPPRESS |
                     AuthorFormatter::CAPITALIZATION_NORMAL;

        $formatter = new AuthorFormatter($format);

        foreach ($authors as $a) {
            $author = new AuthorNormalizer([
                'givenName'  => $a->given,
                'familyName' => $a->family
            ]);
            $output[] = $author->format($formatter);
        }

        return implode($separator, $output);
    }
}
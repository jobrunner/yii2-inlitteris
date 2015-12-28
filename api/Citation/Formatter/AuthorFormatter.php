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
 * Class StandardAuthorFormatter
 * It formats an author to <given name> <family name> without any format or additional options given.
 *
 * @package Mett\Citation\Formatter
 */
class AuthorFormatter implements AuthorFormatterInterface
{
    const SEQ_GIVEN_BLANK_FAMILY       = 0x0000;  //  0000 0000 0000 0000 - Karl-Heinz Müller
    const SEQ_FAMILY_BLANK_GIVEN       = 0x0001;  //  0000 0000 0000 0001 - Müller Karl-Heinz
    const SEQ_FAMILY_COMMA_GIVEN       = 0x0002;  //  0000 0000 0000 0010 - Müller, Karl-Heinz
    const SEQ_FAMILY                   = 0x0003;  //  0000 0000 0000 0011 - Müller
                                                  //  0000 0000 0000 0011 - Maks: 0x0003

    const CAPITALIZATION_AS_IS         = 0x0000;  //  0000 0000 0000 0000 - Karl-heinz Dieter
    const CAPITALIZATION_NORMAL        = 0x0010;  //  0000 0000 0001 0000 - Karl-Heinz Dieter
    const CAPITALIZATION_ALL_UPPERCASE = 0x0020;  //  0000 0000 0010 0000 - KARL-HEINZ DIETER
    const CAPITALIZATION_SMALL_CAPS    = 0x0030;  //  0000 0000 0011 0000 - KARL-HEINZ DIETER (mixed Fonts)
                                                  //  0000 0000 0011 0000 - Maks: 0x0030

    const GIVEN_NAME_ABBR_NO           = 0x0000;  //  0000 0000 0000 0000 - Karl Dieter, Karl-Heinz Dieter
    const GIVEN_NAME_ABBR_ALL          = 0x0100;  //  0000 0001 0000 0000 - K. D., K.-H. D.
    const GIVEN_NAME_ABBR_FROM_SECOND  = 0x0200;  //  0000 0010 0000 0000 - Karl D., Karl-Heinz D.
                                                  //  0000 0011 0000 0000 - Maks: 0x0300

    const GIVEN_NAME_ALL               = 0x0000;  //  0000 0000 0000 0000 - Karl-Heinz Franz Dieter Mafred
    const GIVEN_NAME_FIRST             = 0x0400;  //  0000 0100 0000 0000 - Karl-Heinz
    const GIVEN_NAME_SECOND            = 0x0800;  //  0000 1000 0000 0000 - Karl-Heinz Franz
    const GIVEN_NAME_THIRD             = 0x0c00;  //  0000 1100 0000 0000 - Karl-Heinz Franz Dieter
                                                  //  0000 1100 0000 0000 - Maks: 0x0c00

    const ALTERNATIVE_NAMES_SUPPRESS   = 0x0000;  //  0000 0000 0000 0000 - Karl
    const ALTERNATIVE_NAMES_INSTEAD    = 0x1000;  //  0001 0000 0000 0000 - Carl
    const ALTERNATIVE_NAMES_ADD        = 0x2000;  //  0010 0000 0000 0000 - Karl [= Carl]
                                                  //  0011 0000 0000 0000 - Mask: 0x3000

    /**
     * Bit mask for sequence configuration flag
     * @var int
     */
    protected $_sequenceMask           = 0x0003;

    // 111

    /**
     * Bit mask for capitalization configuration flag
     * @var int
     */
    protected $_capitalizationMask     = 0x0030;

    /**
     * Bit mask for given name abbreviation configuration flag
     * @var int
     */
    protected $_givenNameAbbrMask      = 0x0300;

    /**
     * Bit mask for given name abbreviation configuration flag
     * @var int
     */
    protected $_givenNameMask          = 0x0c00;

    /**
     * Bit mask for alternative names configuration flag
     * @var int
     */
    protected $_alternativeNamesMask   = 0x3000;

    /**
     * Format flag.
     * @var int
     */
    protected $_format                 = 0x0000;


    /**
     * Constructor.
     *
     * @param int            $format        Optional OR'ed flags
     */
    public function __construct($format = 0x0000)
    {
        $this->_format          = $format;
    }


    /**
     * Formats author.
     *
     * @param Author $author    Author instance to format
     * @param int    $format    Optional. Format flags
     * @param array  $options   Optional. Format options.
     *
     * @return string
     */
    public function format(Author $author)
    {
        switch ($this->_format & $this->_sequenceMask) {
            case self::SEQ_FAMILY_COMMA_GIVEN:
                return sprintf('%1$s, %2$s', $this->familyName($author), $this->givenName($author));

            case self::SEQ_FAMILY_BLANK_GIVEN:
                return sprintf('%1$s %2$s', $this->familyName($author), $this->givenName($author));

            case self::SEQ_FAMILY:
                return sprintf('%1$s', $this->familyName($author));

            case self::SEQ_GIVEN_BLANK_FAMILY:
            default:
                return sprintf('%2$s %1$s', $this->familyName($author), $this->givenName($author));
        }
    }


    public function familyName(Author $author)
    {
        $name = $this->_composeFamilyName($author->familyName, $author->altFamilyName);

        return $this->_capitalizationFilter($name);
    }


    public function givenName(Author $author)
    {
        $givenName    = $this->_configureGivenName($author->givenName);

        $altGivenName = $this->_configureAlternativeGivenName($author->altGivenName);
        $name         = $this->_composeGivenName($givenName, $altGivenName);

        return $this->_capitalizationFilter($name);
    }


    protected function _composeFamilyName($familyName, $altFamilyName)
    {
        $name = $familyName;

        switch ($this->_format & $this->_alternativeNamesMask) {
            case self::ALTERNATIVE_NAMES_INSTEAD:
                if (empty($altFamilyName)) {
                    $name = $familyName;
                } else {
                    $name = $altFamilyName;
                }
                break;

            case self::ALTERNATIVE_NAMES_ADD:
                if (empty($altFamilyName)) {
                    $name = $familyName;
                } else {
                    $name = $familyName . "[= " . $altFamilyName . "]";
                }
                break;
        }

        return $name;
    }


    protected function _configureGivenName($givenName)
    {
        $givenNameList = $this->_splitAndReduceGivenNames($givenName);

        switch ($this->_format & $this->_givenNameAbbrMask) {
            case self::GIVEN_NAME_ABBR_ALL:
                $givenNameList = $this->_abbreviateNamesInArray($givenNameList, 0);
                break;

            case self::GIVEN_NAME_ABBR_FROM_SECOND:
                $givenNameList = $this->_abbreviateNamesInArray($givenNameList, 1);
                break;
        }

        return implode(' ', $givenNameList);
    }


    protected function _configureAlternativeGivenName($alternativeGivenName)
    {
        $altGivenNameList = $this->_splitAndReduceGivenNames($alternativeGivenName);

        switch ($this->_format & $this->_givenNameAbbrMask) {
            case self::GIVEN_NAME_ABBR_ALL:
                $altGivenNameList = $this->_abbreviateNamesInArray($altGivenNameList, 0);
                break;

            case self::GIVEN_NAME_ABBR_FROM_SECOND:
                $altGivenNameList = $this->_abbreviateNamesInArray($altGivenNameList, 1);
                break;
        }

        return implode(' ', $altGivenNameList);
    }


    protected function _composeGivenName($givenName, $altGivenName)
    {
        switch ($this->_format & $this->_alternativeNamesMask) {
            case self::ALTERNATIVE_NAMES_INSTEAD:
                if (empty($altGivenName)) {
                    $name = $givenName;
                } else {
                    $name = $altGivenName;
                }
                break;

            case self::ALTERNATIVE_NAMES_ADD:
                if (empty($altGivenName)) {
                    $name = $givenName;
                } else {
                    $name = $givenName . " [= " . $altGivenName . "]";
                }
                break;
            case self::ALTERNATIVE_NAMES_SUPPRESS:
            default:
                $name = $givenName;
        }

        return $name;
    }


    protected function _capitalizationFilter($name)
    {
        switch ($this->_format & $this->_capitalizationMask) {
            case self::CAPITALIZATION_ALL_UPPERCASE:
            case self::CAPITALIZATION_SMALL_CAPS:
                $name = strtoupper($name);
                break;

            case self::CAPITALIZATION_NORMAL:
                $name = ucwords($name, " \t\r\n\f\v-");
                break;
        }

        return $name;
    }


    protected function _splitAndReduceGivenNames($givenNameString)
    {
        $givenNames = preg_split('/\s/', $givenNameString);

        switch ($this->_format & $this->_givenNameMask) {
            case self::GIVEN_NAME_FIRST:
                return array_splice($givenNames, 0, 1);

            case self::GIVEN_NAME_SECOND:
                return array_splice($givenNames, 0, 2);

            case self::GIVEN_NAME_THIRD:
                return array_splice($givenNames, 0, 3);

            case self::GIVEN_NAME_ALL:
            default:
                return $givenNames;
        }
    }

    protected function _abbreviateNamesInArray($names, $abbreviateFromNameIndex = 0)
    {
        $result  = [];

        foreach ($names as $nameIndex => $name) {
            $parts = preg_split('/-/', $name, -1, PREG_SPLIT_OFFSET_CAPTURE);

            if ($nameIndex < $abbreviateFromNameIndex) {
                $result[] =  $name;

                continue;
            }

            $string = '';
            for ($index = 0; $index < count($parts); $index++) {

                list($subName, $separatorPosition) = $parts[$index];

                $separator = ($index > 0) ? substr($name, $separatorPosition - 1, 1) : '';
                $string    = $string . $separator . substr(rtrim($subName, ' .'), 0, 1) . '.';
            }

            $result[] = $string;

        }

        return $result;
    }
}
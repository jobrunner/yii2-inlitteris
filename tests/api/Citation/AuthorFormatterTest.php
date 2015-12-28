<?php

use jobrunner\inlitteris\api\Citation\Author;
use jobrunner\inlitteris\api\Citation\Formatter\AuthorFormatter;

class AuthorFormatterTest extends PHPUnit_Framework_TestCase
{
    /**
     * @group authorformatter
     */
    public function testFormatStandardCase()
    {
        $authorString  = 'Fuss-schnarrenberger, Carl-Friedrich-Peter Amar-Thomas Manfredo [= Fuss-Schnarchenberger, Karl-Friedrich]';
        $caseFormatMap = [
            10 => [
                'format' => AuthorFormatter::SEQ_FAMILY |
                            AuthorFormatter::CAPITALIZATION_AS_IS,
                'result' => 'Fuss-schnarrenberger'
            ],
            11 => [
                'format' => AuthorFormatter::SEQ_FAMILY |
                            AuthorFormatter::CAPITALIZATION_NORMAL,
                'result' => 'Fuss-Schnarrenberger'
            ],
            12 => [
                'format' => AuthorFormatter::SEQ_FAMILY |
                            AuthorFormatter::CAPITALIZATION_ALL_UPPERCASE,
                'result' => 'FUSS-SCHNARRENBERGER'
            ],
            13 => [
                'format' => AuthorFormatter::SEQ_FAMILY |
                            AuthorFormatter::CAPITALIZATION_SMALL_CAPS,
                'result' => 'FUSS-SCHNARRENBERGER'
            ],
            14 => [
                'format' => AuthorFormatter::SEQ_FAMILY |
                            AuthorFormatter::CAPITALIZATION_AS_IS |
                            AuthorFormatter::ALTERNATIVE_NAMES_INSTEAD,
                'result' => 'Fuss-Schnarchenberger'
            ],
            15 => [
                'format' => AuthorFormatter::SEQ_GIVEN_BLANK_FAMILY |
                            AuthorFormatter::CAPITALIZATION_AS_IS,
                'result' => 'Carl-Friedrich-Peter Amar-Thomas Manfredo Fuss-schnarrenberger'
            ],
            16 => [
                'format' => AuthorFormatter::SEQ_FAMILY_BLANK_GIVEN |
                            AuthorFormatter::CAPITALIZATION_AS_IS,
                'result' => 'Fuss-schnarrenberger Carl-Friedrich-Peter Amar-Thomas Manfredo'
            ],
            17 => [
                'format' => AuthorFormatter::SEQ_FAMILY_COMMA_GIVEN |
                            AuthorFormatter::CAPITALIZATION_AS_IS,
                'result' => 'Fuss-schnarrenberger, Carl-Friedrich-Peter Amar-Thomas Manfredo'
            ],
            18 => [
                'format' => AuthorFormatter::SEQ_FAMILY_COMMA_GIVEN |
                            AuthorFormatter::CAPITALIZATION_NORMAL,
                'result' => 'Fuss-Schnarrenberger, Carl-Friedrich-Peter Amar-Thomas Manfredo'
            ],

            19 => [
                'format' => AuthorFormatter::SEQ_FAMILY_COMMA_GIVEN |
                            AuthorFormatter::GIVEN_NAME_SECOND |
                            AuthorFormatter::ALTERNATIVE_NAMES_SUPPRESS |
                            AuthorFormatter::CAPITALIZATION_NORMAL,
                'result' => 'Fuss-Schnarrenberger, Carl-Friedrich-Peter Amar-Thomas'
            ],
            20 => [
                'format' => AuthorFormatter::SEQ_FAMILY_COMMA_GIVEN |
                            AuthorFormatter::GIVEN_NAME_ABBR_ALL |
                            AuthorFormatter::ALTERNATIVE_NAMES_SUPPRESS |
                            AuthorFormatter::CAPITALIZATION_NORMAL,
                'result' => 'Fuss-Schnarrenberger, C.-F.-P. A.-T. M.'
            ],
            21 => [
                'format' => AuthorFormatter::SEQ_FAMILY_COMMA_GIVEN |
                            AuthorFormatter::GIVEN_NAME_ABBR_FROM_SECOND |
                            AuthorFormatter::ALTERNATIVE_NAMES_SUPPRESS |
                            AuthorFormatter::CAPITALIZATION_NORMAL,
                'result' => 'Fuss-Schnarrenberger, Carl-Friedrich-Peter A.-T. M.'
            ],
            22 => [
                'format' => AuthorFormatter::SEQ_FAMILY_COMMA_GIVEN |
                            AuthorFormatter::GIVEN_NAME_ABBR_FROM_SECOND |
                            AuthorFormatter::GIVEN_NAME_FIRST |
                            AuthorFormatter::ALTERNATIVE_NAMES_SUPPRESS |
                            AuthorFormatter::CAPITALIZATION_NORMAL,
                'result' => 'Fuss-Schnarrenberger, Carl-Friedrich-Peter'
            ],
            23 => [
                'format' => AuthorFormatter::SEQ_FAMILY_COMMA_GIVEN |
                            AuthorFormatter::GIVEN_NAME_ABBR_FROM_SECOND |
                            AuthorFormatter::GIVEN_NAME_SECOND |
                            AuthorFormatter::ALTERNATIVE_NAMES_SUPPRESS |
                            AuthorFormatter::CAPITALIZATION_NORMAL,
                'result' => 'Fuss-Schnarrenberger, Carl-Friedrich-Peter A.-T.'
            ],
            24 => [
                'format' => AuthorFormatter::SEQ_FAMILY_COMMA_GIVEN |
                            AuthorFormatter::GIVEN_NAME_ABBR_FROM_SECOND |
                            AuthorFormatter::GIVEN_NAME_THIRD |
                            AuthorFormatter::ALTERNATIVE_NAMES_SUPPRESS |
                            AuthorFormatter::CAPITALIZATION_NORMAL,
                'result' => 'Fuss-Schnarrenberger, Carl-Friedrich-Peter A.-T. M.'
            ],
            25 => [
                'format' => AuthorFormatter::SEQ_FAMILY_COMMA_GIVEN |
                            AuthorFormatter::GIVEN_NAME_ABBR_ALL |
                            AuthorFormatter::GIVEN_NAME_SECOND |
                            AuthorFormatter::ALTERNATIVE_NAMES_SUPPRESS |
                            AuthorFormatter::CAPITALIZATION_NORMAL,
                'result' => 'Fuss-Schnarrenberger, C.-F.-P. A.-T.'
            ],


//            26 => [
//                'format' => AuthorFormatter::SEQ_FAMILY_COMMA_GIVEN |
//                            AuthorFormatter::GIVEN_NAME_ABBR_ALL |
//                            AuthorFormatter::GIVEN_NAME_SECOND |
//                            AuthorFormatter::ALTERNATIVE_NAMES_ADD |
//                            AuthorFormatter::CAPITALIZATION_NORMAL,
//                'result' => 'Fuss-Schnarrenberger, C.-F.-P. A.-T. [= K.-F.]'
//            ],

            27 => [
                'format' => AuthorFormatter::SEQ_FAMILY_COMMA_GIVEN |
                            AuthorFormatter::GIVEN_NAME_ABBR_ALL |
                            AuthorFormatter::GIVEN_NAME_SECOND |
                            AuthorFormatter::ALTERNATIVE_NAMES_INSTEAD |
                            AuthorFormatter::CAPITALIZATION_NORMAL,
                'result' => 'Fuss-Schnarchenberger, K.-F.'
            ],


        ];

        foreach ($caseFormatMap as $caseIndex => $testCase) {
            $formatter = new AuthorFormatter($testCase['format']);
            $author    = Author::initWithString($authorString, $formatter);

            $this->assertEquals($testCase['result'], $author->format(), "Case #$caseIndex");
        }
    }
}
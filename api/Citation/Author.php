<?php
/*
 * This file is part of the inlitteris project.
 *
 * (c) Jo Brunner <http://github.com/jobrunner/yii2-inlitteris>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace jobrunner\inlitteris\api\Citation;

use jobrunner\inlitteris\api\Citation\Formatter\AuthorFormatterInterface;
use jobrunner\inlitteris\api\Citation\Formatter\AuthorFormatter;

/**
 * Class Author
 *
 * @package jobrunner\inlitteris\api\Citation
 * @author Jo Brunner <jo@mett.io>
 */
class Author
{
    /**
     * Author's family name
     * @var string
     */
    public $familyName;

    /**
     * Author's given name
     * @var string
     */
    public $givenName;

    /**
     * Alternative spelling of author's family name
     * @var string
     */
    public $altFamilyName;

    /**
     * Alternative spelling of author's given name or inital of given name
     * @var string
     */
    public $altGivenName;

    /**
     * Corporate/Organisation name
     * @var string
     */
    public $corporateName;

    /**
     * Alternative spelling of an organisation name
     * @var string
     */
    public $altCorporateName;

    /**
     * Formatter instance
     * @var AuthorFormatterInterface|null
     */
    protected $_formatter = null;


    /**
     * Constructor
     *
     * @param array                   $defaults. Keys of the array should be public properties of the class Author
     * @param AuthorFormatterInterface|null $formatter
     */
    public function __construct(array $defaults = [], AuthorFormatterInterface $formatter = null)
    {
        foreach ($defaults as $name => $value) {
            $this->{$name} = $value;
        }

        if (null == $formatter) {
            $formatter = new AuthorFormatter();
        }

        $this->_formatter = $formatter;
    }


    /**
     * Init an Author instance with standard author format:
     * <family name>, <given name as initials or mixed with full given name and/or initials> or
     * <familyName> [<initial>.[-], ...]
     * Either <family name> or <given name> may have an alternative spelling in the
     * form [= <alternative name or initials>]
     *
     * Standard case:
     * <lastname> [= alternative spelling lastname], <firstname or abbreviation> [= <alt. spelling of firstname or abbreviations]|[= <alt. spelling lastname>, <alt. spelling firstname or abbr>])
     *       Rosenschoeld [= Rosenschöld], E. M.
     *       Rosenschoeld, C. M. [= K. M.]
     *       Rosenschoeld [= Rosenschöld], C. M. [= K. M.]
     *       Rosenschoeld, C. M. [= Rosenschöld, K. M.]
     *
     * Corporate case:
     * <corporate name>, [= <alt. corporate name>]
     *       Bundesamt für Landwirtschaft und Forsten,
     *       Landesamt für Strahlenschäden an der Umwelt, [= Umweltamt für Strahlung,]
     *
     * Special case:
     * <last name> <abbreviated firstnames>
     *      Iablokoff-Khnzorian S. M.
     *      Iablokoff-Khnzorian [= Khnzorian] S. M.
     *      Iablokoff-Khnzorian  S. M. [= Z. M.]
     *
     * E.g., not allowed:
     *      Rosenschoeld, C. M. [= Kai-Moritz]
     *      because Kai-Moritz could be an alternative spelling of the last name Rosenschoeld
     *
     *
     *
     * @param $authorString
     * @param AuthorFormatterInterface|null $formatter
     *
     * @return Author
     */
    public static function initWithString($authorString, AuthorFormatterInterface $formatter = null)
    {
        $familyName       = null;
        $givenName        = null;
        $altFamilyName    = null;
        $altGivenName     = null;
        $corporateName    = null;
        $altCorporateName = null;

        $alternativeName  = null;

        if (preg_match('/^([^,]+),\s*(\[=\s[^,]+,\]\s*|)$/u', $authorString, $matches)) {
            $corporateName    = trim($matches[1], ' ,');
            $altCorporateName = trim($matches[2], ' ,[]=');

            return new self([
                'givenName'        => null,
                'familyName'       => null,
                'altGivenName'     => null,
                'altFamilyName'    => null,
                'corporateName'    => empty($corporateName)    ? null : $corporateName,
                'altCorporateName' => empty($altCorporateName) ? null : $altCorporateName,
            ], $formatter);
        }


        if (preg_match('/^([^,]+),\s*(.+)$/u', $authorString, $matches)) {

            $familyName              = trim($matches[1]);

            if (preg_match('/\[=\s+([^\]]+)\]/u', $familyName, $altFamilyNameMatches)) {
                $altFamilyName = trim($altFamilyNameMatches[1]);
                $familyName    = trim(preg_replace('/\[=\s+([^\]]+)\]/u', '', $familyName));
            }

            $givenName  = trim($matches[2]);

            if (preg_match('/(.+)\s+\[=\s+([^\]]+)\]$/u', $givenName, $altGivenNameMatches)) {

                $givenName       = trim($altGivenNameMatches[1]);
                $alternativeName = trim($altGivenNameMatches[2]);

                if (preg_match('/^([^,]+),(.*)$/u', $alternativeName, $altGivenNameMatches)) {
                    $altFamilyName = trim($altGivenNameMatches[1]);
                    $altGivenName  = trim($altGivenNameMatches[2]);
                } else if (preg_match('/^([^,.]+)$/u', $alternativeName, $altGivenNameMatches)) {
                    $altFamilyName = trim($altGivenNameMatches[1]);
                } else if (preg_match('/^([^,]+)$/u', $alternativeName, $altGivenNameMatches)) {
                    $altGivenName  = trim($altGivenNameMatches[1]);
                }
            }

            return new self([
                'givenName'        => $givenName,
                'familyName'       => $familyName,
                'altGivenName'     => $altGivenName,
                'altFamilyName'    => $altFamilyName,
                'corporateName'    => null,
                'altCorporateName' => null,
            ], $formatter);
        }

        // If an alternative spelling is given it will be removed from family and given names
        // and separately stored into alternative family and given names.
        if (preg_match('/\[=\s+([^\]]+)\]/u', $authorString, $matches)) {
            $alternativeName = trim($matches[1]);

            // remove alternative name from authorString
            $authorString    = trim(preg_replace('/\[=\s+([^\]]+)\]/u', '', $authorString));

            // decide whether alternative name is an alternative given name.
            // If it is not, it will be treated as alternative family name.
            if (preg_match('/^((?:-{0,1}[A-Z][a-z]{0,1}\.)*)$/u', $alternativeName, $altMatches)) {
                $altGivenName  = $alternativeName;
            } else {
                $altFamilyName = $alternativeName;
            }
        }

        if (preg_match('/([\w\s-]+)((?:(?:\s|-)[A-Z][a-z]{0,1}\.)*)(\s(?:de|von|du|van der)){0,1}$/u', $authorString, $matches)) {
            $familyName = trim($matches[1]);
            $givenName  = trim($matches[2]);

            if (!empty($matches[3])) {
                $familyName = $familyName . ' ' . trim($matches[3]);
            }
        }

        return (new self([
            'familyName'    => $familyName,
            'givenName'     => $givenName,
            'altFamilyName' => $altFamilyName,
            'altGivenName'  => $altGivenName,
        ], $formatter));
    }


    /**
     * Returns a formatted author string.
     * If it isn't configured any formatter explicitly StandardAuthorFormatter is used as fall back.
     *
     * @param AuthorFormatterInterface|null $formatter
     *
     * @return string
     */
    public function format(AuthorFormatterInterface $formatter = null)
    {
        if (null != $formatter) {

            return $formatter->format($this);
        }

        return $this->_formatter->format($this);
    }
}
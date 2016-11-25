<?php
namespace jobrunner\inlitteris\components;

/**
 * UUID generator.
 * Generates valid RFC 4211 compliant Universally Unique IDentifiers (UUID) version 3, 4 and 5.
 * UUIDs generated validate using the OSSP UUID Tool, and the output for named-based UUIDs are
 * exactly the same. This is a pure PHP implementation.
 *
 * @author Andrew Moore, originally found at: http://www.php.net/manual/en/function.uniqid.php#94959
 * @author Henry Merriam <php@henrymerriam.com>, constants and documentation
 *
 * Usage:
 *
 * Named-based UUID:
 *      $v3uuid = Uuid::v3('1546058f-5a25-4334-85ae-e68f2a44bbaf', 'SomeRandomString');
 *      $v5uuid = Uuid::v5(UUID::NS_URL, 'http://www.google.com/');
 *
 * Pseudo-random UUID:
 *      $v4uuid = Uuid::v4();
 *
 *
 *
 * Modifications made by Henry Merriam <php@henrymerriam.com> on 2009-12-20:
 *
 *   + Added constants for predefined namespaces as defined in RFC 4211 Appendix C.
 *     + NS_DNS
 *     + NS_URL
 *     + NS_ISO_UID
 *     + NS_X500_DN
 *
 */
class Uuid
{
    /**
     * Namespace UUID for fully-qualified Domain Name (FQDN in DNS)
     */
    const NS_DNS     = '6ba7b810-9dad-11d1-80b4-00c04fd430c8';

    /**
     * Namespace UUID for an Uniform Resource Locator (URL)
     */
    const NS_URL     = '6ba7b811-9dad-11d1-80b4-00c04fd430c8';

    /**
     * Namespace UUID for an ISO Object Identifier (OID)
     */
    const NS_ISO_OID = '6ba7b812-9dad-11d1-80b4-00c04fd430c8';

    /**
     * Namespace UUID for an X.500 DN (in DER or a text output format)
     */
    const NS_X500_DN = '6ba7b814-9dad-11d1-80b4-00c04fd430c8';

    /**
     * Generates name-based md5 hashed UUID v3.
     *
     * @param $namespace
     * @param $name
     *
     * @return bool|string
     */
    public static function v3($namespace, $name) 
    {
        if (!self::isValid($namespace)) {

            return false;
        }
        
        // Get hexadecimal components of namespace
        $nhex = str_replace(array('-','{','}'), '', $namespace);

        // Binary Value
        $nstr = '';
        
        // Convert Namespace UUID to bits
        for ($i = 0; $i < strlen($nhex); $i+=2) {
            $nstr .= chr(hexdec($nhex[$i].$nhex[$i+1]));
        }

        // Calculate hash value
        $hash = md5($nstr . $name);

        return sprintf('%08s-%04s-%04x-%04x-%12s',
                       // 32 bits for "time_low"
                       substr($hash, 0, 8),
                
                       // 16 bits for "time_mid"
                       substr($hash, 8, 4),
                
                       // 16 bits for "time_hi_and_version",
                       // four most significant bits holds version number 3
                       (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x3000,
                
                       // 16 bits, 8 bits for "clk_seq_hi_res",
                       // 8 bits for "clk_seq_low",
                       // two most significant bits holds zero and one for variant DCE1.1
                       (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000,
                
                       // 48 bits for "node"
                       substr($hash, 20, 12));
    }

    /**
     * Generates pseudo-random UUID v4.
     * This UUID is used e.g.:
     * - Microsofts Globally Unique Identifier (GUID)
     * - Java class: java.util.UUID
     * - Qt class: QUuid
     *
     * @return string
     */
    public static function v4() 
    {
        return sprintf('%04x%04x-%04x-%04x-%04x-%04x%04x%04x',

                       // 32 bits for "time_low"
                       mt_rand(0, 0xffff), mt_rand(0, 0xffff),
                
                       // 16 bits for "time_mid"
                       mt_rand(0, 0xffff),
                
                       // 16 bits for "time_hi_and_version",
                       // four most significant bits holds version number 4
                       mt_rand(0, 0x0fff) | 0x4000,
                
                       // 16 bits, 8 bits for "clk_seq_hi_res",
                       // 8 bits for "clk_seq_low",
                       // two most significant bits holds zero and one for variant DCE1.1
                       mt_rand(0, 0x3fff) | 0x8000,
                
                       // 48 bits for "node"
                       mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff));
    }

    /**
     * Generates pseudo-random UUID v4.
     * Format is a 128 Bit (16 Byte) binary.
     *
     * @return string
     */
    public static function v4binary16()
    {
        return pack('H*', sprintf('%04x%04x%04x%04x%04x%04x%04x%04x',

                       // 32 bits for "time_low"
                       mt_rand(0, 0xffff), mt_rand(0, 0xffff),

                       // 16 bits for "time_mid"
                       mt_rand(0, 0xffff),

                       // 16 bits for "time_hi_and_version",
                       // four most significant bits holds version number 4
                       mt_rand(0, 0x0fff) | 0x4000,

                       // 16 bits, 8 bits for "clk_seq_hi_res",
                       // 8 bits for "clk_seq_low",
                       // two most significant bits holds zero and one for variant DCE1.1
                       mt_rand(0, 0x3fff) | 0x8000,

                       // 48 bits for "node"
                       mt_rand(0, 0xffff), mt_rand(0, 0xffff), mt_rand(0, 0xffff)));
    }

    /**
     * Generates a v5 name-based sha1 hashed UUID v5.
     *
     * @param $namespace
     * @param $name
     *
     * @return bool|string
     */
    public static function v5($namespace, $name) 
    {
        if (!self::isValid($namespace)) {
            
            return false;
        }

        // Get hexadecimal components of namespace
        $nhex = str_replace(array('-','{','}'), '', $namespace);
        
        // Binary Value
        $nstr = '';

        // Convert Namespace UUID to bits
        for($i = 0; $i < strlen($nhex); $i+=2) {
            $nstr .= chr(hexdec($nhex[$i].$nhex[$i+1]));
        }

        // Calculate hash value
        $hash = sha1($nstr . $name);

        return sprintf('%08s-%04s-%04x-%04x-%12s',
                       // 32 bits for "time_low"
                       substr($hash, 0, 8),
                        
                       // 16 bits for "time_mid"
                       substr($hash, 8, 4),
                        
                       // 16 bits for "time_hi_and_version",
                       // four most significant bits holds version number 5
                       (hexdec(substr($hash, 12, 4)) & 0x0fff) | 0x5000,
                        
                       // 16 bits, 8 bits for "clk_seq_hi_res",
                       // 8 bits for "clk_seq_low",
                       // two most significant bits holds zero and one for variant DCE1.1
                       (hexdec(substr($hash, 16, 4)) & 0x3fff) | 0x8000,
                        
                       // 48 bits for "node"
                       substr($hash, 20, 12));
    }

    /**
     * Validates all types of UUIDs
     *
     * @param $uuid UUID with or without separators or {}-delimiters
     *
     * @return bool
     */
    public static function isValid($uuid) 
    {
        return (true == preg_match('/^\{?[0-9a-f]{8}\-?[0-9a-f]{4}\-?[0-9a-f]{4}\-?'
                          . '[0-9a-f]{4}\-?[0-9a-f]{12}\}?$/i', $uuid));
    }

    /**
     * Converts a binary representation of a UUID into 36 characters string representation
     *
     * @param $binary16 A binary representation of a UUID.
     *
     * @return string
     */
    public static function hexUUIDFromBinary16($binary16)
    {
        $s = unpack("H*", $binary16)[1];
        return strtoupper(sprintf("%s-%s-%s-%s-%s",
                                  substr($s,  0,  8),
                                  substr($s,  8,  4),
                                  substr($s, 12,  4),
                                  substr($s, 16,  4),
                                  substr($s, 20, 12)));
    }
}
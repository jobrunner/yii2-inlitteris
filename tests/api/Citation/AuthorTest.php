<?php

use jobrunner\inlitteris\api\Citation\Author;
use jobrunner\inlitteris\api\Citation\Formatter\AuthorFormatter;

class AuthorTest extends PHPUnit_Framework_TestCase
{
    /**
     * @group author
     */
    public function testClass_1()
    {
        $authorString = 'Tournier';

        $author = Author::initWithString($authorString);

        $this->assertTrue($author instanceof Author);
        $this->assertClassHasAttribute('familyName', '\jobrunner\inlitteris\api\Citation\Author');
        $this->assertClassHasAttribute('givenName', '\jobrunner\inlitteris\api\Citation\Author');
        $this->assertEquals('Tournier', $author->familyName);
        $this->assertEquals('', $author->givenName);
    }

    /**
     * @group author
     */
    public function testClass_2()
    {
        $author = new Author();

        $this->assertNull($author->familyName);
        $this->assertNull($author->givenName);
    }

    /**
     * @group author
     */
    public function testClass_3()
    {
        $author = new Author(['familyName' => 'Üß', 'givenName' => 'blubb']);

        $this->assertEquals('Üß', $author->familyName);
        $this->assertEquals('blubb', $author->givenName);
    }

    /**
     * @group author
     */
    public function testClass_4()
    {
        $author = new Author(['unknown' => 'blubb']);

        $this->assertEquals('blubb', $author->unknown);
    }

    /**
     * @group author
     */
    public function testSimple_1()
    {
        $authorString = 'Tournier H.';

        $author = Author::initWithString($authorString);

        $this->assertEquals('Tournier', $author->familyName);
        $this->assertEquals('H.', $author->givenName);
    }

    /**
     * @group author
     */
    public function testSimple_2()
    {
        $authorString = 'Tournier Et.';

        $author = Author::initWithString($authorString);

        $this->assertEquals('Tournier', $author->familyName);
        $this->assertEquals('Et.', $author->givenName);
    }

    /**
     * @group author
     */
    public function testSimple_3()
    {
        $authorString = 'Chûjô M.';

        $author = Author::initWithString($authorString);

        $this->assertEquals('Chûjô', $author->familyName);
        $this->assertEquals('M.', $author->givenName);
    }

    /**
     * @group author
     */
    public function testSimple_4()
    {
        $authorString = 'Roudier A. J.';

        $author = Author::initWithString($authorString);

        $this->assertEquals('Roudier', $author->familyName);
        $this->assertEquals('A. J.', $author->givenName);
    }

    /**
     * @group author
     */
    public function testSimple_5()
    {
        $authorString = 'Marshall G. A. K.';

        $author = Author::initWithString($authorString);

        $this->assertEquals('Marshall', $author->familyName);
        $this->assertEquals('G. A. K.', $author->givenName);
    }

    /**
     * @group author
     */
    public function testSimple_6()
    {
        $authorString = 'Nasreddinov Kh. A.';

        $author = Author::initWithString($authorString);

        $this->assertEquals('Nasreddinov', $author->familyName);
        $this->assertEquals('Kh. A.', $author->givenName);
    }

    /**
     * @group author
     */
    public function testSimple_7()
    {
        $authorString = 'Ter-Minasian M. E.';

        $author = Author::initWithString($authorString);

        $this->assertEquals('Ter-Minasian', $author->familyName);
        $this->assertEquals('M. E.', $author->givenName);
    }

    /**
     * @group author
     */
    public function testSimple_8()
    {
        $authorString = 'Salgueira Cerezo F.';

        $author = Author::initWithString($authorString);

        $this->assertEquals('Salgueira Cerezo', $author->familyName);
        $this->assertEquals('F.', $author->givenName);
    }

    /**
     * @group author
     */
    public function testSimple_9()
    {
        $authorString = 'Velázquez de Castro A. J.';

        $author = Author::initWithString($authorString);

        $this->assertEquals('Velázquez de Castro', $author->familyName);
        $this->assertEquals('A. J.', $author->givenName);
    }

    /**
     * @group author
     */
    public function testSimple_10()
    {
        $authorString = 'Romstöck-Völkl M.';

        $author = Author::initWithString($authorString);

        $this->assertEquals('Romstöck-Völkl', $author->familyName);
        $this->assertEquals('M.', $author->givenName);
    }

    /**
     * @group author
     */
    public function testSimple_11()
    {
        $authorString = 'Friedman A.-L.-L.';

        $author = Author::initWithString($authorString);

        $this->assertEquals('Friedman', $author->familyName);
        $this->assertEquals('A.-L.-L.', $author->givenName);
    }


    /**
     * @group author
     */
    public function testSimple_12()
    {
        $authorString = 'Jacquelin du Val P. N. C.';

        $author = Author::initWithString($authorString);

        $this->assertEquals('Jacquelin du Val', $author->familyName);
        $this->assertEquals('P. N. C.', $author->givenName);
    }

    /**
     * @group author
     */
    public function testTricky_1()
    {
        $authorString = 'Wulfen F. X. von';

        $author = Author::initWithString($authorString);

        $this->assertEquals('Wulfen von', $author->familyName);
        $this->assertEquals('F. X.', $author->givenName);
    }

    /**
     * @group author
     */
    public function testTricky_2()
    {
        $authorString = 'Rottenberg A. L. M. von';

        $author = Author::initWithString($authorString);

        $this->assertEquals('Rottenberg von', $author->familyName);
        $this->assertEquals('A. L. M.', $author->givenName);
    }

    /**
     * @group author
     */
    public function testTricky_3()
    {
        $authorString = 'Weele H. W. van der';

        $author = Author::initWithString($authorString);

        $this->assertEquals('Weele van der', $author->familyName);
        $this->assertEquals('H. W.', $author->givenName);
    }
// .

    /**
     * @group author
     */
    public function testTricky_4()
    {
        $authorString = 'Villers C. J. de';

        $author = Author::initWithString($authorString);

        $this->assertEquals('Villers de', $author->familyName);
        $this->assertEquals('C. J.', $author->givenName);
    }


    /**
     * @group author
     */
    public function testTricky_5()
    {
        $authorString = 'de los Mozos Pascual M.';

        $author = Author::initWithString($authorString);

        $this->assertEquals('de los Mozos Pascual', $author->familyName);
        $this->assertEquals('M.', $author->givenName);
    }

    /**
     * @group author
     */
    public function testTricky_6()
    {
        $authorString = 'Zhang R.-Zh.';

        $author = Author::initWithString($authorString);

        $this->assertEquals('Zhang', $author->familyName);
        $this->assertEquals('R.-Zh.', $author->givenName);
    }

    /**
     * @group author
     */
    public function testAlteranteNames_1()
    {
        $authorString = 'Fuss C. [= K.]';
        $author       = Author::initWithString($authorString);

        $this->assertEquals('Fuss', $author->familyName);
        $this->assertEquals('C.', $author->givenName);

        $this->assertNull($author->altFamilyName);
        $this->assertEquals('K.', $author->altGivenName);
    }

    /**
     * @group author
     */
    public function testAlteranteNames_2()
    {
        $authorString = 'Iablokoff-Khnzorian [= Khnzorian] S. M.';
        $author       = Author::initWithString($authorString);

        $this->assertEquals('Iablokoff-Khnzorian', $author->familyName);
        $this->assertEquals('S. M.', $author->givenName);
        $this->assertEquals('Khnzorian', $author->altFamilyName);
        $this->assertEquals(null, $author->altGivenName);
    }

    /**
     * @group author
     */
    public function testAlteranteNames_3()
    {
        $authorString = 'Rosenschoeld [= Rosenschöld] E. M.';
        $author = Author::initWithString($authorString);

        $this->assertEquals('Rosenschoeld', $author->familyName);
        $this->assertEquals('E. M.', $author->givenName);
        $this->assertEquals('Rosenschöld', $author->altFamilyName);
        $this->assertEquals(null, $author->altGivenName);
    }

    /**
     * @group author
     */
    public function testStandardName_1()
    {
        $authorString = 'Rosenschöld, E. M.';
        $author       = Author::initWithString($authorString);

        $this->assertEquals('Rosenschöld', $author->familyName);
        $this->assertEquals('E. M.', $author->givenName);
    }

    /**
     * @group author
     */
    public function testStandardName_2()
    {
        $authorString = 'Rosenschoeld [= Rosenschöld], E. M.';
        $author       = Author::initWithString($authorString);

        $this->assertEquals('Rosenschoeld', $author->familyName);
        $this->assertEquals('E. M.', $author->givenName);
        $this->assertEquals('Rosenschöld', $author->altFamilyName);
        $this->assertEquals(null, $author->altGivenName);
    }

    /**
     * @group author
     */
    public function testStandardName_3()
    {
        $authorString = 'Fuss, C. [= K.]';
        $author       = Author::initWithString($authorString);

        $this->assertEquals('Fuss', $author->familyName);
        $this->assertEquals('C.', $author->givenName);

        $this->assertNull($author->altFamilyName);
        $this->assertEquals('K.', $author->altGivenName);
    }

    /**
     * @group author
     */
    public function testStandardName_4()
    {
        $authorString  = 'Fuss-schnarrenberger, Carl-Friedrich-Peter Amar-Thomas [= Fuss-Schnarchenberger, Karl-Friedrich]';
        $author       = Author::initWithString($authorString);

        $this->assertEquals('Fuss-schnarrenberger', $author->familyName);
        $this->assertEquals('Carl-Friedrich-Peter Amar-Thomas', $author->givenName);

        $this->assertEquals('Fuss-Schnarchenberger', $author->altFamilyName);
        $this->assertEquals('Karl-Friedrich', $author->altGivenName);
    }

    /**
     * @group author
     */
    public function testStandardName_5()
    {
        $authorString  = 'Fuss-schnarrenberger, Carl-Friedrich-Peter Amar-Thomas [= Fuss-Schnarchenberger, Karl-Friedrich]';
        $author       = Author::initWithString($authorString);

        $this->assertEquals('Fuss-schnarrenberger', $author->familyName);
        $this->assertEquals('Carl-Friedrich-Peter Amar-Thomas', $author->givenName);

        $this->assertEquals('Fuss-Schnarchenberger', $author->altFamilyName);
        $this->assertEquals('Karl-Friedrich', $author->altGivenName);
    }

    /**
     * @group author
     */
    public function testWithAlternativeVariation()
    {
        $this->markTestSkipped('Input rules should be defined.');

        // An input format is needed for special rules of given names.
        $authorString  = 'Fuss-schnarrenberger [= Fuss-Schnarchenberger], Carl-Friedrich-Peter Amar-Thomas [= Karl-Friedrich]';
        $author       = Author::initWithString($authorString);

        $this->assertEquals('Fuss-schnarrenberger', $author->familyName);
        $this->assertEquals('Carl-Friedrich-Peter Amar-Thomas', $author->givenName);
        $this->assertEquals('Fuss-Schnarchenberger', $author->altFamilyName);
        $this->assertEquals('Karl-Friedrich', $author->altGivenName);
    }


    /**
     * @group author
     */
    public function testCorporateName_1()
    {
        $authorString = 'Bundesamt für Landwirtschaft und Forsten,';
        $author       = Author::initWithString($authorString);

        $this->assertNull($author->familyName);
        $this->assertNull($author->givenName);
        $this->assertNull($author->altFamilyName);
        $this->assertNull($author->altGivenName);
        $this->assertEquals('Bundesamt für Landwirtschaft und Forsten', $author->corporateName);
        $this->assertNull($author->altCorporateName);
    }

    /**
     * @group author
     */
    public function testCorporateName_2()
    {
        $authorString = 'Landesamt für Strahlenschäden an der Umwelt, [= Umweltamt für Strahlung,]';
        $author       = Author::initWithString($authorString);

        $this->assertNull($author->familyName);
        $this->assertNull($author->givenName);
        $this->assertNull($author->altFamilyName);
        $this->assertNull($author->altGivenName);
        $this->assertEquals('Landesamt für Strahlenschäden an der Umwelt', $author->corporateName);
        $this->assertEquals('Umweltamt für Strahlung', $author->altCorporateName);
    }
}

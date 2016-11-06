<?php

use jobrunner\inlitteris\api\CiteProcessor;

class CiteProcessorTest extends PHPUnit_Framework_TestCase
{
    public $reference;

    public function setUp()
    {
        $this->reference = (object)[];
    }


    /**
     * @group citeprocessor
     */
    public function testAutor_1()
    {
        $reference               = (object)[];
        $reference->{'author'}[] = (object)[
            'family' => 'Velázquez de Castro',
            'given'  => 'Antonio J.'
        ];

        $processor = new CiteProcessor();
        $result    = $processor->renderAuthor($reference);

        $this->assertEquals('Velázquez De Castro, A. J.', $result);
   }

    /**
     * @group citeprocessor
     */
    public function testAutor_2()
    {
        $reference             = (object)[];
        $reference->{'author'} = [];

        $processor = new CiteProcessor();
        $result    = $processor->renderAuthor($reference);

        $this->assertEquals('S.a.', $result);
    }

    /**
     * @group citeprocessor
     */
    public function testYear_1()
    {
        $reference             = (object)[];
        $reference->{'issued'} = (object)[
            "date-parts" => [['2016'], ['01'], ['18']]
        ];

        $processor = new CiteProcessor();
        $result    = $processor->renderYear($reference);

        $this->assertEquals('2016', $result);
    }

    /**
     * @group citeprocessor
     */
    public function testYear_2()
    {
        $reference             = (object)[];
        $reference->{'issued'} = (object)[
            "date-parts" => [['2016'], ['01'], ['18']]
        ];

        $processor = new CiteProcessor();
        $result    = $processor->renderYear($reference);

        $this->assertEquals('2016', $result);
    }
}
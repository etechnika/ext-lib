<?php
namespace Etechnika\ExtLib\Domain;


/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.1 on 2013-09-22 at 17:54:16.
 */
class TldListTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var TldList
     */
    protected $object;


    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new TldList;
    }


    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }


    /**
     * @covers Etechnika\ExtLib\Domain\TldList::get
     */
    public function testGet()
    {
        $this->assertTrue( in_array( 'pl', $this->object->get() ), 'pl' );
        $this->assertTrue( in_array( 'com.pl', $this->object->get() ), '.com.pl' );
    }


    /**
     * @covers Etechnika\ExtLib\Domain\TldList::getLevel
     * @dataProvider providerGetLevel
     */
    public function testGetLevel( $strTld, $intLevel, $booTrue )
    {
        if ( $booTrue )  {
            $this->assertTrue( in_array( $strTld, $this->object->get( $intLevel ) ), $strTld );
        }
        else {
            $this->assertFalse( in_array( $strTld, $this->object->get( $intLevel ) ), $strTld );
        }
    }


    public function providerGetLevel()
    {
        // array( tld, level, exists )
        return array(
            array( 'pl', 1, true ),
            array( 'www.com.pl', 3, false ),
            array( '', 1, false ),
            array( 1, 1, false ),
            array( 'xn--0zwm56d', 1, true ),
            array( 'الاردن', 1, false ), // encoded .xn--mgbayh7gpa
        );
    }
}

<?php

namespace Etechnika\ExtLib\Domain;

require_once dirname( __FILE__ ) .'/DomainNameTestFixture.php';

use Etechnika\ExtLib\Domain\DomainUtils;
use Etechnika\IdnaConvert\IdnaConvert;
use PHPUnit_Framework_TestCase;
use Symfony\Component\Config\Definition\Exception\Exception;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2014-01-23 at 15:24:52.
 *
 * @cover DomainUtils
 */
class DomainUtilsTest extends PHPUnit_Framework_TestCase
{

    /**
     * @var DomainUtils
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
//        $this->object = new DomainUtils;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    /**
     * @param string $strIn
     * @param string $strOut
     * @param string $booTrue
     * @covers Etechnika\ExtLib\Domain\DomainUtils::idnaEncode
     * @dataProvider providerIdnaEncode
     */
    public function testIdnaEncode($strIn, $strOut, $booTrue)
    {
        if ($booTrue) {
            $strOut === IdnaConvert::encodeString($strIn) ? $this->assertTrue(true) : $this->assertFalse(false);
        } else {
            $strOut !== IdnaConvert::encodeString($strIn) ? $this->assertTrue(true) : $this->assertFalse(false);
        }
    }

    /**
     * Data provider
     *
     * @return array
     */
    public function providerIdnaEncode()
    {
        return array(
            array('żółw.pl', 'a.xn--w-uga1v8h.pl', true), // PL idn
            array('a.рф', 'a.xn--p1ai', true), // Russia
            array('a.الاردن', 'a.xn--mgbayh7gpa', false), // Jordan
            array('a.الاردن', 'a.xn--mgbayh7gpa', true), // Jordan
            array('a.الارد', 'a.xn--mgbayh7gpa', true),
            array('a.عمان', 'a.xn--mgb9awbf', true),
            array('a.சிங்கப்பூர்"', 'a.xn--clchc0ea0b2g2a9gcd', true),
        );
    }

    /**
     * @param string $strIn
     * @param string $strOut
     * @param string $booTrue
     * @covers Etechnika\ExtLib\Domain\DomainUtils::idnaDecode
     * @dataProvider providerIdnaDecode
     */
    public function testIdnaDecode($strIn, $strOut, $booTrue)
    {
        if ($booTrue) {
            $strOut === IdnaConvert::decodeString($strIn) ? $this->assertTrue(true) : $this->assertFalse(false);
        } else {
            $strOut !== IdnaConvert::decodeString($strIn) ? $this->assertTrue(true) : $this->assertFalse(false);
        }
    }

    /**
     * Data provider
     *
     * @return array
     */
    public function providerIdnaDecode()
    {
        return array(
            array('xn--w-uga1v8h.pl', 'żółw.pl', true), // PL idn
            array('a.xn--p1ai', 'a.рф', true), // Russia
            array('a.xn--mgbayh7gpa', 'a.الاردن', true), // Jordan
            array('a.xn--mgbayh7gpa', 'a.الاردن', true), // Jordan
            array('a.xn--mgb9awbf.', 'a.عمان', true),
            array('a.xn--clchc0ea0b2g2a9gcd', 'a.சிங்கப்பூர்"', true),
        );
    }

    /**
     * @covers Etechnika\ExtLib\Domain\DomainUtils::isValid
     * @dataProvider providerIsValid
     */
    public function testIsValid($strIn, $booIntranet, $booTrue)
    {
        try {
            if ($booTrue) {
                $this->assertTrue(DomainUtils::isValid($strIn, $booIntranet), 'Domain name: '. $strIn .' Intranet: '. var_export($booIntranet, true));
            } else {
                $this->assertFalse(DomainUtils::isValid($strIn, $booIntranet), 'Domain name: '. $strIn .' Intranet: '. var_export($booIntranet, true));
            }
        } catch (Exception $e) {
            $this->fail('Unexpected exception');
        } // endtry
    }

    /**
     * Data provider
     *
     * @return array
     */
    public function providerIsValid()
    {
        return DomainNameTestFixture::providerAllDomains();
    }

}

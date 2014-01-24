<?php

namespace Etechnika\ExtLib\Domain;


/**
 * Description of DomainNameTestFixture
 *
 * @author Tomasz Rutkowski <tomasz@rutkowski.co>
 */
class DomainNameTestFixture
{
    /**
     * The list conains the correct domain names
     *
     * @var array
     */
    public static $arrCorrectInternetDomainNames = array(
        'aaaaaaaaa.pl',
        'ArdDFGR.pl',
        'aa3333aaaaaaa.pl',
        'aa-aaaaaaa.pl',
        'aa--aaaaaaa.pl',
        'aa---aaaaaaa.pl',
        '1aaaaa2.pl',
    );

    /**
     * List of correct domain name
     *
     * This list may contain domain not allowed on internet
     *
     * @var array
     */
    public static $arrCorrectDomainNames = array(
        'aaaaaaaaa.my-network',
        'aaaaaaaaa.localhost',
        'aaaaaaaaa.locale',
    );

    /**
     *
     * @var array
     */
    public static $arrCorrectInternetIdnDomainNames = array(
        'xn--w-uga1v8h.pl', // Poland
        'a.xn--p1ai', // Russia
        'a.xn--mgbayh7gpa', // Jordan
        'a.xn--mgbayh7gpa', // Jordan
        'a.xn--mgb9awbf',
        'a.xn--clchc0ea0b2g2a9gcd',
    );

    /**
     *
     * @var array
     */
    public static $arrCorrectIdnDomainNames = array(
        'xn--w-uga1v8h.local',
    );

    /**
     *
     * @var array
     */
    public static $arrWrongInternetDomainNames = array(
        '',
        'aaaaaaaaa',
        '.aaaaaaaaa',
        'aaaaaaaaa.',
        '.aaaaaaaaa.pl',
        'aaaaa..aaaa.pl',
        'aaaaa...aaaa.pl',
        '-aaaa.pl',
        'aaaa-.pl',
        'aaaaaaaaa.my-network',
        'aaaaaaaaa.localhost',
        'aaaaaaaaa.locale',
    );

    /**
     *
     * @var array
     */
    public static $arrWrongDomainNames = array(
        '',
        'aaaaaaaaa',
        '.aaaaaaaaa',
        'aaaaaaaaa.',
        '.aaaaaaaaa.pl',
        'aaaaa..aaaa.pl',
        'aaaaa...aaaa.pl',
        '-aaaa.pl',
        'aaaa-.pl',
    );

    /**
     *
     * @var array
     */
    public static $arrWrongInternetIdnDomainNames = array(
        'żółw.pl', // Poland
        'a.рф', // Russia
        'a.الاردن', // Jordan
        'a.الاردن', // Jordan
        'a.الارد',
        'a.عمان',
        'a.சிங்கப்பூர்"',
    );

    /**
     *
     * @var array
     */
    public static $arrWrongIdnDomainNames = array(
        '',
        'ółęśź.pl',
        'xn--.pl',
    );

    /**
     * Data provider
     *
     * @return array ( domain_name, intranet, correct )
     */
    public static function providerAllDomains()
    {
        $arrResult = array();
        foreach (self::$arrCorrectInternetDomainNames as $strTmpDomainName) {
            $arrResult[] = array($strTmpDomainName, false, true);
        }
        foreach (self::$arrCorrectInternetIdnDomainNames as $strTmpDomainName) {
            $arrResult[] = array($strTmpDomainName, false, true);
        }
        foreach (self::$arrCorrectDomainNames as $strTmpDomainName) {
            $arrResult[] = array($strTmpDomainName, true, true);
        }
        foreach (self::$arrCorrectIdnDomainNames as $strTmpDomainName) {
            $arrResult[] = array($strTmpDomainName, true, true);
        }
        foreach (self::$arrWrongInternetDomainNames as $strTmpDomainName) {
            $arrResult[] = array($strTmpDomainName, false, false);
        }
        foreach (self::$arrWrongInternetIdnDomainNames as $strTmpDomainName) {
            $arrResult[] = array($strTmpDomainName, false, false);
        }
        foreach (self::$arrWrongDomainNames as $strTmpDomainName) {
            $arrResult[] = array($strTmpDomainName, true, false);
        }
        foreach (self::$arrWrongIdnDomainNames as $strTmpDomainName) {
            $arrResult[] = array($strTmpDomainName, true, false);
        }

        return $arrResult;
    }
}
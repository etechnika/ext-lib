<?php

namespace Etechnika\ExtLib\Domain;

use Etechnika\IdnaConvert\IdnaConvert;


/**
 * Description of DomainUtils
 *
 * @author Tomasz Rutkowski <tomasz@rutkowski.co>
 */
class DomainUtils
{

    /**
     * Decode domain name
     *
     * @param string $strDomainName
     *
     * @return string
     */
    public static function idnaDecode($strDomainName)
    {
        return IdnaConvert::decodeString($strDomainName);
    }

    /**
     * Encode domain name
     *
     * @param string $strDomainName
     *
     * @return string
     */
    public static function idnaEncode($strDomainName)
    {
        return IdnaConvert::encodeString($strDomainName);
    }

    /**
     * Check domain name
     * 
     * @see Domain::__construct
     * @param string  $strDomainName
     * @param boolean $booIntranet
     *
     * @return boolean
     */
    public static function isValid($strDomainName, $booIntranet = false)
    {
        $arrCheckList = explode('.', $strDomainName);

        foreach ($arrCheckList as $strTmpName) {
            if (preg_match('/^[0-9a-z\-]+$/i', $strTmpName) < 1 || preg_match('/(^\-|\-$)/', $strTmpName) === 1 || strpos($strDomainName, '.') === false) {

                return false;
            }
        } // endforeach

        if (preg_match('/^(?P<part>[[:alnum:]]([[:alnum:]\-]*[[:alnum:]])?)(\.(?&part))+$/i', $strDomainName) !== 1) {

            return false;
        }

        if (!TldUtils::isValid(array_pop($arrCheckList), $booIntranet)) {

            return false;
        }

        return true;
    }
}
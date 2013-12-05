<?php

/*
 * This file is part of the Etechnika package.
 *
 * (c) Tomasz Rutkowski <tomasz@rutkowski.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace Etechnika\ExtLib\Domain;


/**
 * Utils class
 *
 * @author Tomasz Rutkowski <tomasz@rutkowski.co>
 */
class TldUtils
{

    /**
     * Check tld
     *
     * @param string  $strTld    Tld
     * @param boolean $booStrict Only tld from list
     *
     * @return boolean
     */
    public static function isValid($strTld, $booStrict = true)
    {
        $strTld = static::removeDot($strTld);
        $objTldList = new TldList();

        if ($booStrict) {
            return in_array($strTld, $objTldList->get());
        }

        if (strpos($strTld, '.') === false) {
            $arrCheckList = array($strTld);
        } else {
            $arrCheckList = explode('.', $strTld);
        } // endif

        foreach ($arrCheckList as $strTmpTld) {
            if (preg_match('/^[0-9a-z]+[0-9a-z\-]*[0-9a-z]+$/', $strTmpTld) < 1) {
                return false;
            }
        } // endforeach
        //return preg_match( '/^([0-9a-z\-\.]*[\.]{1})*[0-9a-z\-]+$/', $strTmpTld ) >= 1;
        return true;
    }

    /**
     * Remove first dot from tld
     *
     * @param string $strTld
     *
     * @return string
     */
    public static function removeDot($strTld)
    {
        return strpos($strTld, '.') === 0 ? substr($strTld, 1) : $strTld;
    }

    /**
     * Return tld level
     *
     * @param string $strTld
     * 
     * @return integer
     */
    public static function getLevel($strTld)
    {
        $strTld = self::removeDot((string) $strTld);
        if (empty($strTld)) {
            return 0;
        }

        return count(explode('.', (string) $strTld));
    }
}
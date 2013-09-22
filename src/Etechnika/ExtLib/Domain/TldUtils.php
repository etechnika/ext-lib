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
     * @param string $strTld
     * @return boolean
     */
    public static function isValid( $strTld )
    {
        $strTld = static::removeDot( $strTld );
        $objTldList = new TldList();

        return in_array( $strTld, $objTldList->get() );
    }


    /**
     * Remove first dot from tld
     *
     * @param string $strTld
     * @return string
     */
    public static function removeDot( $strTld )
    {
        return strpos( $strTld, '.' ) === 0 ? substr( $strTld, 1 ) : $strTld;
    }


    /**
     * Return tld level
     *
     * @return integer
     */
    public static function getLevel( $strTld )
    {
        $strTld = self::removeDot( (string) $strTld );
        if ( empty( $strTld ) ) {
            return 0;
        }
        return count( explode( '.', (string) $strTld ) );
    }

}


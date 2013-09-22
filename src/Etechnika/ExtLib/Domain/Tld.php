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
 * Class load new version tld list
 *
 * @author Tomasz Rutkowski <tomasz@rutkowski.co>
 */
class Tld
{
    /**
     * Tld
     *
     * @var string
     */
    private $strTld;


    /**
     *
     * @param String $strTld
     */
    public function __construct( $strTld )
    {
        $this->strTld = TldUtils::removeDot( $strTld );
        if ( ! TldUtils::isValid( $this->strTld ) ) {
            throw new InvalidTldException( 'Invalid tld' );
        }
    }


    /**
     * Return tld
     *
     * @return string
     */
    public function getTld()
    {
        return $this->strTld;
    }


    /**
     * Return tld level
     *
     * @return integer
     */
    public function getLevel()
    {
        return TldUtils::getLevel( $this->getTld() );
    }
}


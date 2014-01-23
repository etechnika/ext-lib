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
     * Create object
     *
     * @param string $strTld
     * @param string $booIntranet
     *
     * @return Tld
     * @throws InvalidTldException
     */
    public static function create($strTld, $booIntranet = false)
    {
        return new static($strTld, $booIntranet);
    }

    /**
     * Construct
     *
     * @param String  $strTld
     * @param boolean $booIntranet
     *
     * @throws InvalidTldException
     */
    public function __construct($strTld, $booIntranet = false)
    {
        $strTld = TldUtils::removeDot($strTld);
        if (!TldUtils::isValid($strTld, $booIntranet)) {
            throw new InvalidTldException('Invalid tld');
        }
        $this->strTld = strtolower($strTld);
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
        return TldUtils::getLevel($this->getTld());
    }

    /**
     * Is tld idn
     *
     * <example>
     * xn--w-uga1v0h - true
     * xn--w-uga1v0h.pl - true
     * xn--w-uga1v0h.xn--w-uga1v0h - true
     * aaaa.xn--w-uga1v0h - true
     * aaaa.pl - false
     * </example>
     *
     * @return boolean
     */
    public function isIdn()
    {
        return strpos($this->getTld(), 'xn--') !== false;
    }

    /**
     * Return tld
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getTld();
    }

    /**
     * Return tld
     *
     * @see __toString
     * @return string
     */
    public function __invoke()
    {
        return $this->getTld();
    }
}
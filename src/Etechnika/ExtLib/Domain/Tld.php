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
    private $strName;

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
            throw new InvalidTldException('Invalid tld "' . var_export($strTld, true) . '"');
        }
        $this->strName = strtolower($strTld);
    }

    /**
     * Return tld
     *
     * @return string
     */
    public function getName()
    {
        return $this->strName;
    }

    /**
     * Return tld level
     *
     * @return integer
     */
    public function getLevel()
    {
        return TldUtils::getLevel($this->getName());
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
        return strpos($this->getName(), 'xn--') !== false;
    }

    /**
     * Return tld
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Return tld
     *
     * @see __toString
     * @return string
     */
    public function __invoke()
    {
        return $this->getName();
    }
}
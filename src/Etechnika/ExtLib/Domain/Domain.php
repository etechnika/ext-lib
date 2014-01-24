<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Etechnika\ExtLib\Domain;

use Exception;
use InvalidArgumentException;


/**
 * Domain class
 *
 * @author Tomasz Rutkowski <tomasz@rutkowski.co>
 */
class Domain
{
    /**
     * Domain name
     *
     * @var string
     */
    private $strDomainName = null;

    /**
     *  Is the domain name to be correct not only the Internet but also on the local network
     *
     * @var boolean
     */
    private $booIntranet = null;

    /**
     *
     * @param string  $strDomainName
     * @param boolean $booIntranet Is the domain name to be correct not only the Internet but also on the local network
     * @return Domian
     * @throws InvalidDomainException
     */
    public static function create($strDomainName, $booIntranet = false)
    {
        return new static($strDomainName, $booIntranet);
    }

    /**
     * Construct and validate domain
     *
     * @param string  $strDomainName
     * @param boolean $booIntranet Is the domain name to be correct not only the Internet but also on the local network
     * @throws InvalidDomainException
     */
    public function __construct($strDomainName, $booIntranet = false)
    {
        $booIntranet = (boolean) $booIntranet;
        if (!DomainUtils::isValid($strDomainName, $booIntranet)) {
            throw new InvalidDomainException('Invalid domain name "' . var_export($strDomainName, true) . '"');
        }
        $this->strDomainName = strtolower($strDomainName);
        $this->booIntranet = $booIntranet;
    }

    /**
     * Return domain name
     *
     * @return string
     */
    public function getDomainName()
    {
        return $this->strDomainName;
    }

    /**
     * Is the domain name to be correct not only the Internet but also on the local network
     *
     * @return boolean
     */
    public function isIntranet()
    {
        return $this->booIntranet;
    }

    /**
     * Return domain name without tld
     *
     * @return string
     */
    public function getName()
    {
        list($strName, ) = explode('.', $this->getDomainName());

        return $strName;
    }

    /**
     * Is domain name idn
     *
     * <example>
     * xn--w-uga1v0h.pl - true
     * xn--w-uga1v0h.pl - true
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
     * Return parent domain
     *
     * @return Domain
     * @throws Exception
     */
    public function hasParentDomain()
    {
        return $this->isSubdomain();
    }

    /**
     * Return parent domain
     *
     * @return Domain
     * @throws Exception
     */
    public function getParentDomain()
    {
        if (!$this->hasParentDomain()) {
            throw new InvalidDomainException();
        }
        return static::create($this->getTldNameOrSubdomainName(), $this->isIntranet());
    }

    /**
     * Is this domain subdomain
     *
     * @return boolean
     */
    public function isSubdomain()
    {
        if (TldUtils::isValid($this->getTldNameOrSubdomainName(), $this->isIntranet())) {
            return false;
        }
        return true;
    }

    /**
     * Return tld name or subdomain name
     *
     * @return string
     */
    public function getTldNameOrSubdomainName()
    {
        return substr($this->getDomainName(), strpos($this->getDomainName(), '.') + 1);
    }

    /**
     * Return tld object
     *
     * @return Tld
     */
    public function getTld()
    {
        if ($this->isSubdomain()) {
            throw new InvalidTldException('Invalid tld "' . var_export($this->getTldNameOrSubdomainName(), true) . '"');
        }
        return Tld::create($this->getTldNameOrSubdomainName(), $this->isIntranet());
    }

    /**
     * Return domain name
     *
     * @return string
     */
    public function __toString()
    {
        return $this->getDomainName();
    }

    /**
     * Return domain name
     *
     * @return string
     */
    public function __invoke()
    {
        return $this->getDomainName();
    }
}
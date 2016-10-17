<?php

namespace proxy;

class Configurate implements \IteratorAggregate
{
    const HTTP = 'http';
    const SOCKS4 = 'socks4';
    const SOCKS5 = 'socks5';

    /** @var String */
    public $api_key = null;

    /** @var bool */
    public $get = true;

    /** @var bool */
    public $post = true;

    /** @var bool */
    public $cookies = true;

    /** @var bool */
    public $referer = true;

    /** @var bool */
    public $user_agent = true;

    /** @var bool */
    public $supportsHttps = true;

    /** @var int */
    public $anonymityLevel = 1;

    /** @var String */
    public $protocol = self::HTTP;

    /** @var integer */
    public $port = 8080;

    /** @var String */
    public $country = null;

    /** @var integer */
    public $maxCheckPeriod = null;

    /**
     * Configurate constructor.
     * @param $api_key
     * @param $port
     * @param $country
     * @param $protocol
     * @param $maxCheckPeriod
     */
    public function __construct($api_key, $port, $country, $protocol, $maxCheckPeriod)
    {
        $this->api_key = $api_key;
        $this->port = $port;
        $this->country = $country;
        $this->protocol = $protocol;
        $this->maxCheckPeriod = $maxCheckPeriod;
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this);
    }
}
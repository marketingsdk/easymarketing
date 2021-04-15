<?php

namespace Marketingsdk\EasyMarketing\Kernel;

use Marketingsdk\EasyMarketing\Util\Generic\Client as genericClient;
use Marketingsdk\EasyMarketing\Util\AES\Client as aesClient;
use Marketingsdk\EasyMarketing\Kernel\Util\Alipay\EasySDKKernel;
use Marketingsdk\EasyMarketing\Alipay\Clue\Client as clueClient;
use Marketingsdk\EasyMarketing\Alipay\Page\Client as pageClient;

class Marketing
{
    public $config = null;
    public $kernel = null;
    private static $instance;
    protected static $util;
    protected static $alipay;

    private function __construct($config)
    {
        $kernel = new EasySDKKernel($config);
        self::$alipay = new Alipay($kernel);
        self::$util = new Util($kernel);
    }

    public static function setOptions($config)
    {
        if (!(self::$instance instanceof self)) {
            self::$instance = new self($config);
        }
        return self::$instance;
    }

    public static function alipay()
    {
        return self::$alipay;
    }

    public static function util()
    {
        return self::$util;
    }
}

class Alipay
{
    private $kernel;

    public function __construct($kernel)
    {
        $this->kernel = $kernel;
    }

    public function clue()
    {
        return new clueClient($this->kernel);
    }

    public function page()
    {
        return new pageClient($this->kernel);
    }
}

class Util
{
    private $kernel;

    public function __construct($kernel)
    {
        $this->kernel = $kernel;
    }

    public function generic()
    {
        return new genericClient($this->kernel);
    }

    public function aes(){
        return new aesClient($this->kernel);
    }
}


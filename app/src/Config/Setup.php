<?php

namespace src\Config;

class Setup {

    static public $protocol;
    static public $protocolAndHost;
    static public $assetsPath;

    public function __construct() {
        self::$protocol = $_SERVER['SERVER_NAME'] == 'localhost' ? 'http://' : 'https://';
        self::$protocolAndHost = $_SERVER['SERVER_NAME'] == 'localhost' ? self::$protocol . $_SERVER['SERVER_NAME'] . "/mvc" : self::$protocol . $_SERVER['SERVER_NAME'];
        self::$assetsPath = self::$protocolAndHost . "/Public";
    }

}

<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace src\Controllers;

use src\Config\Setup;

/**
 * Description of API
 *
 * @author Daniel
 */
class APIController extends Setup {

    private $config;

    public function __construct() {
        parent::__construct();
    }

    public function Home($param = array()) {
       
         return require_once dirname(__DIR__) . '/Views/Home.php';
     //  return require_once("E:/WAMPSERVER/www/test/app/src/Controllers/Views/Home.php");
    }
}

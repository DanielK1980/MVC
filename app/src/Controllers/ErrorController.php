<?php

namespace src\Controllers;

use src\Config\Setup;


/**
 * Description of ImagesController
 *
 * @author Daniel
 */
class ErrorController extends Setup {

    public function __construct() {
        parent::__construct();
    }
	
	
    public function Error404($param = array()) {
       
            return require_once dirname(__DIR__). '/Views/Error404.php';
        
    }	
	
	
}
<?php

namespace src\Config;

use src\Config\Setup;

//use src\Controllers\ViewController;

class Route extends Setup {

    protected $controller;
    protected $method;
    protected $url;
    protected $param = array();

    public function __construct(array $param) {
        parent::__construct();
        
        if (!empty($param)) {
            foreach ($param as $key => $arg) {
                if ($key == "action") {
                    if (method_exists($this, $arg)) {
                        $this->method = $arg;
                    } else {
                        //header("Location: " . $this::$protocolAndHost . "/calendar");
                        return header("Location: " . $this::$protocolAndHost . "/Error/Error404");
                    }
                } else {
                    $this->param[$key] = $arg;
                }
            }
        }
    }
    public function LoadView() {
        $this->ViewParamUrl();
        $nam = "src\\Controllers\\" . $this->controller;
        $controller = new $nam();

        if (!method_exists($controller, $this->method)) {

            return header("Location: " . $this::$protocolAndHost . "/Error/Error404");
            //  header("Location: " . $this::$protocolAndHost . "/calendar");
        }
        return $controller->{"$this->method"}($this->param);
    }

    protected function ViewParamUrl() {
        $urlfirst = $_SERVER['SERVER_NAME'] == "localhost" ? str_replace("/mvc/", "", $_SERVER['REQUEST_URI']) : $_SERVER['REQUEST_URI'];
        $url = explode("?", $urlfirst);
        $cutURL = array_values(array_filter(explode("/", $url[0])));
        $method = 0;
        $param = "";
        if (!empty($cutURL) && isset($cutURL[0]) && !isset($cutURL[1])) {
            $this->method = "View";
        }
        if (!empty($cutURL) && isset($cutURL[0])) {
            foreach ($cutURL as $val){             
                if ($method == 0 && empty(strstr($val, '?'))) {
                    $path = dirname(__DIR__) . '/Controllers/' . ucwords($val) . 'Controller.php';
                    $isFile = file_exists($path);
                    if (!empty($val) && $isFile) {
                        $this->controller = ucwords($val) . "Controller";
                    } else {
                        return header("Location: " . $this::$protocolAndHost . "/Error/Error404");
                    }
                }
                if ($method == 1 && empty(strstr($val, '?'))) {
                    $nam = "src\\Controllers\\" . ucwords($this->controller);
                    $controller = new $nam();
                    if (method_exists($controller, $val)) {
                        $this->method = $val;
                    } else {
                        return header("Location: " . $this::$protocolAndHost . "/Error/Error404");                     
                    }
                }
                if ($method > 1 && empty(strstr($val, '?'))) {
                    $this->param[] = $val;
                }
                $method++;
            }
        }
        if (empty($cutURL)) {
            $this->controller = "ErrorController";
            $this->method = "Error404";
        }
    }
}

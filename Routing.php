<?php
namespace BWB\Framework\mvc;

class Routing
{

    
    private $config;
    private $uri;
    private $route;
    private $controller;
    private $args;
    private $method;


    function __construct()
    {
        $DS = DIRECTORY_SEPARATOR;
        $directory = explode($DS, __DIR__);
        unset($directory[count($directory) - 1]);
        $root = implode($DS, $directory);
        $this->config = json_decode(
            file_get_contents($root . $DS . "config" . $DS . "routing.json"),
            true
        );
        $this->args = array();
    }

   
    public function execute()
    {
        $uri = explode("?", $_SERVER['REQUEST_URI'])[0];
        $this->uri = explode("/", $uri);
        $this->method = $_SERVER['REQUEST_METHOD'];
        foreach ($this->config as $key => $value) {
            $this->route = explode("/", $key);
            $this->controller = "BWB\\Framework\\mvc\\controllers\\" . $this->getValue($value);
            if ($this->isEqual()) {
                if ($this->compare()) {
                    break;
                }

            }
        }
    }

    
    private function isEqual()
    {
        if (strpos($this->uri[count($this->uri) - 1], "?") === 0) {
            unset($this->uri[count($this->uri) - 1]);
        }
        return (count($this->uri) === count($this->route)) ? true : false;
    }

    
    private function getValue($value)
    {
        if (is_array($value)) {
            return (isset($value[$this->method])) ? $value[$this->method] : null;
        } else {
            return $value;
        }
    }

    
    private function addArgument($i)
    {
        if (!empty($this->route[$i])) {
            $pos = strpos("(:)", $this->route[$i]);
            if ($pos === 0) {
                array_push($this->args, $this->uri[$i]);
                return true;
            }
        }
        return false;
    }

    
    private function compare()
    {
        for ($index = 0; $index < count($this->route); $index++) {
            if ($this->route[$index] !== $this->uri[$index]) {
                if (!$this->addArgument($index)) {
                    return false;
                }
            }
        }
        $this->invoke();
    }

    
    private function invoke()
    {
        $elements = explode(":", $this->controller);

        $object = new $elements[0]();

        return call_user_func_array(array($object, $elements[1]), $this->args);
    }

}
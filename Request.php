<?php

namespace BWB\Framework\mvc;


class Request {

    
    private static $post, $get, $put;

    
    public function get($key = null) {
        if($key === null){
            return $_GET;
        }else if(isset($_GET[$key])){
            return $_GET[$key];
        }
        return null;
    }

    public function post($types = null) {
        if (isset($_POST[$types])) {
            return $_POST[$types];
        } else if (class_exists($types)) {
            return $this->hydrateEntity(new $types(), $_POST);
        } else if (is_null($types)) {
            return $_POST;
        } else {
            return null;
        }
    }

    public function put($types = null) {
        $datas = array();
        parse_str(file_get_contents("php://input"), $datas);
        if (isset($datas[$types])) {
            return $datas[$types];
        } else if (class_exists($types)) {
            return $this->hydrateEntity(new $types(), $datas);
        } else if (is_null($types)) {
            return $datas;
        } else {
            return null;
        }
    }

   
    public function hydrateEntity($entity, $datas) {
        foreach ($datas as $key => $value) {
            $setter = "set" . ucfirst($key);
            if (method_exists($entity, $setter)) {
                $entity->$setter($value);
            }
        }
        return $entity;
    }

    public function files() {
        
    }
}

<?php
namespace BWB\Framework\mvc;

use BWB\Framework\mvc\SecurityMiddleware;


abstract class Controller {
    
    private $get;
    private $post;
    private $put;
    protected $response;
    protected $request;
    protected $security;
    
    
    protected function securityLoader() {
        $this->security = new SecurityMiddleware();
    }
    
    function __construct() {
        $this->get = $_GET;
        $this->post = $_POST;
        parse_str(file_get_contents("php://input"), $this->put);
        $this->securityLoader();
        $this->response = new Response($this->security);
        $this->request = new Request();
    }

    
    protected function inputGet(){
        return $this->get;
    }
    
    
    protected function inputPost() {
        return $this->post;
    }
    
   
    protected function inputPut() {
        return $this->put;
    }
    
    
    final protected function render($pathToView,$datas=null) {
        $user = null;
        if(!is_null($this->security)){
            $user = $this->security->acceptConnexion();
            $user = (!$user)?null:$user;
        }        
        if(is_array($datas)){
            foreach ($datas as $key => $value) {
                $$key = $value;
            }
        }
        include './views/' . $pathToView . ".php";
    }
}
?>
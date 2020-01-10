<?php
namespace BWB\Framework\mvc;

class Response
{
    private $security;
    function __construct($security)
    {
        $this->security = $security;
    }


   
    final public function sendJSON($data)
    {
        header('Content-Type: application/json');
        if(is_array($data)){
            echo json_encode($data);
        }elseif(is_string($data)){
            echo $data;
        }elseif($data instanceof \JsonSerializable){
            echo json_encode($data->jsonSerialize());
        }else{
            // doit lever une UnauthorizedTypeException 
            throw new Exception();
        }
    }


   
    final public function status(int $code = 200){
        http_response_code($code);
        return $this;
    }

    
    final public function render($pathToView, $datas = null)
    {
        $user = null;
        if (!is_null($this->security)) {
            $user = $this->security->acceptConnexion();
            $user = (!$user) ? null : $user;
        }
        if (is_array($datas)) {
            foreach ($datas as $key => $value) {
                $$key = $value;
            }
        }
        include './views/' . $pathToView . ".php";
    }
}
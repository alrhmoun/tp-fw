<?php

namespace BWB\Framework\mvc\controllers;

use BWB\Framework\mvc\Controller;
use BWB\Framework\mvc\models\DefaultModel;
use BWB\Framework\mvc\models\TestModel;
use Exception;

class DefaultController extends Controller
{

   
    function __construct()
    {
        parent::__construct();
    }

    
    public function getDefault()
    {
        $this->response->render("default");
    }

    
    public function login()
    {
        $this->security->generateToken(new DefaultModel());
        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/token");
    }

    
    public function logout()
    {
        $this->security->deactivate();
        header("Location: http://" . $_SERVER['SERVER_NAME'] . "/token");
    }

   
    public function token()
    {
        var_dump($this->security->acceptConnexion());
    }


    public function getDatasFromGET()
    {
        var_dump($this->inputGet());
    }

    
    public function getDatasFromPOST()
    {
        var_dump($this->inputPost());
    }

    
    public function getDatasFromPUT()
    {
        var_dump($this->inputPut());
    }

  
    public function delete()
    {
        var_dump($this->inputPut());
        var_dump($this->inputPost());
        var_dump($this->inputGet());
    }

    
    public function getByValue($value)
    {
        echo "valeur passée dans l'uri : " . $value;
    }



    public function test()
    {
        $r = new \BWB\Framework\mvc\Request();
        var_dump($r->post(TestModel::class));
        var_dump($r->put(TestModel::class));
    }

    public function getViewFiles()
    {
        $this->render("form-upload");
    }
    public function uploadFiles()
    {
        var_dump($_FILES);

    }

    public function getJSON()
    {
        $this->response->sendJSON(array(
            "toto" => "tata"
        ));
    }
}
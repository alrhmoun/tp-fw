<?php
use PHPUnit\Framework\TestCase;

class DefaultControllerTest extends TestCase{
    protected static $controller;
    
    public function load(){
        self::$controller = new BWB\Framework\mvc\controllers\DefaultController();
    }
    public function testNoError(){
        
        $this->assertNotNull(self::$controller);
    }
}

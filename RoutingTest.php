<?php
use PHPUnit\Framework\TestCase;

class RoutingTest extends TestCase{
    protected $routing;
    
    
    public function testConstruct() {
        $this->routing = new BWB\Framework\mvc\Routing();
    }
    public function testConfigAsArray() {
        $_SERVER['DOCUMENT_ROOT'] = "coco";
        $reflec = new ReflectionClass($this->routing);
        $config = $reflec->getProperty("config");
        $config->setAccessible(true);
        $this->assertNotNull($config->getValue($this->routing));
    }
}

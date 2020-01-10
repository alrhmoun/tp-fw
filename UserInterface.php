<?php
namespace BWB\Framework\mvc;

interface UserInterface {
    
    public function getUsername();
    public function getPassword();
    public function getRoles();
}

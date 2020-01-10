<?php
namespace BWB\Framework\mvc\models;
use BWB\Framework\mvc\UserInterface;

class DefaultModel implements UserInterface{
    public function getPassword() {
        return "doe";
    }

    public function getRoles() {
        return [
            "admin",
            "registered"
        ];
    }

    public function getUsername() {
        return "john";
    }

}

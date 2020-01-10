<?php
namespace BWB\Framework\mvc;

interface CRUDInterface {
    
    public function create($array);
    
    public function retrieve($id);
    
    public function update($array);
    
    public function delete($id);    
}

<?php
class CorRouter {
    private $_ctr = NULL;
    private $_act = NULL;
    private static $_instance = NULL;

    private function __construct($controller = NULL, $action = NULL){
        $_ctr = $controller;
        $_act = $action;    
    }

    private function __clone(){
    }

    public static function getInstance(){
        if($_instance == NULL || !($_instance instanceof self)){
            $_instance = new self();
        }
        return $_instance;
    }

    public function setController($controller){
        $this->_ctr = "Ctr".ucfirst($controller);
    }

    public function setAction($action){
        $this->_act = "act".ucfirst($action);
    }

    public function route(){
        $refClass = new ReflectionClass($this->_ctr);
        if($refClass->hasMethod($this->_act)){
            $obj = $refClass->newInstance();
            $method = $refClass->getMethod($this->_act);
            $method->invoke($obj);
        }else{
            throw new CorException("action not exists",4003);
        }
    }
}

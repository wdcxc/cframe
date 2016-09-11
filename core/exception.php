<?php
class CorException extends Exception{
    public function __construct($message = NULL,$code = 4000){
        parent::__construct($message,$code);
    }
}

<?php

abstract class Model{
    protected $DB;
    protected function __construct(){
        $this->DB = Module_Database::instance();
    }

}
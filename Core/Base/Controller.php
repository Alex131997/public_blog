<?php

abstract class Controller
{
    public function redirect($url){
        header("Location:".$url);
    }
    public function header($header,$value){
        header($header.":".$value);
    }
    public function response($text){
        echo $text;
    }
    public function responseGZ($text){
        if(!strstr($_SERVER["HTTP_ACCEPT_ENCODING"],"gzip")) {
            echo $text;
            return;
        }
        $this->header("Content-Encoding","gzip");
        echo gzencode($text,5);
    }
}
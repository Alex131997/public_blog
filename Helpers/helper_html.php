<?php

class Helper_HTML
{
    public static function CSS($name){
        return "<link rel='stylesheet' href='".URLROOT."Media/css/{$name}.css'>";
    }

    public static function JS($name){
        return "<script type='text/javascript' src='".URLROOT."Media/js/{$name}.js'></script>";
    }
}
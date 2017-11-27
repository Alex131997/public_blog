<?php

class Autoloader
{
    const HELPER = HELPERS_PATH;
    const MODULE = MODULES_PATH;
    const MODEL = MODELS_PATH;


    public static function load($name)
    {
        $name = strtolower($name);
        if (!preg_match("/(\w+)\_(\w+)/i", $name, $res)) return;

        switch ($res[1]){
            case "helper": $path = @self::HELPER; break;
            case "module": $path = @self::MODULE; break;
            case "model": $path = @self::MODEL; break;
        }

        if (empty($path)) return;
        include $path . $name . ".php";
    }
}
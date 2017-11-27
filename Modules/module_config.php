<?php


class Module_Config
{
    public static function load($confname)
    {
        return include CONFIGS_PATH.$confname.".php";
    }
}
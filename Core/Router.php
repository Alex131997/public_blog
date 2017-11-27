<?php

class Router
{
    const DEFAULT_CONTROLLER = "main";
    const DEFAULT_ACTION = "index";
    private static $URIParams=NULL;
    private static function loadURIParams(){
        if(self::$URIParams!==NULL) return;
        $url_str = $_SERVER["REQUEST_URI"];
        $pos = strpos($url_str,"?");
        if($pos!==false) $url_str = substr($url_str,0,$pos);
        $params = explode("/",$url_str);
        self::$URIParams = array_slice($params,FOLDER_COUNT);
    }
    public static function getURIParam($n){
        self::loadURIParams();
        return @self::$URIParams[$n];
    }

    public static function Load($controller =self::DEFAULT_CONTROLLER,$action = self::DEFAULT_ACTION){
        $controller_name = "controller_".$controller;
        $action_name = "action_".$action;
        if(!file_exists(CONTROLLERS_PATH.$controller_name.".php")) throw new Exception("Controller not found",404);
        include_once CONTROLLERS_PATH.$controller_name.".php";
        $ctrl = new $controller_name();
        if(!method_exists($ctrl,$action_name)) throw new Exception("Action not found",404);
        $ctrl->$action_name();
    }
    public static function Run(){
       if(!($controller = self::getURIParam(0))) $controller=self::DEFAULT_CONTROLLER;
       if(!($action = self::getURIParam(1))) $action=self::DEFAULT_ACTION;
       self::Load($controller,$action);
    }
}
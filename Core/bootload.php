<?php

require_once CORE_PATH."Base/Model.php";
require_once CORE_PATH."Base/Controller.php";
require_once CORE_PATH."Base/View.php";
require_once CORE_PATH."Router.php";
require_once CORE_PATH."Autoloader.php";

spl_autoload_register("Autoloader::load");

try {
    Router::Run();
}catch (Exception $e){
    //Router::Load("404");
    echo $e->getMessage();
}
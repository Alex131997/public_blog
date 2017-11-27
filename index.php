<?php

define("URLROOT","/");
define("DOCROOT",$_SERVER["DOCUMENT_ROOT"].URLROOT);
define("FOLDER_COUNT",1);

define("APP_PATH",DOCROOT."App/");
define("VIEW_PATH",APP_PATH."views/");
define("TEMPLATE_PATH",APP_PATH."templates/");
define("CONTROLLERS_PATH",APP_PATH."controllers/");
define("MODELS_PATH",APP_PATH."models/");
define("CORE_PATH",DOCROOT."Core/");
define("CONFIGS_PATH",DOCROOT."Configs/");
define("HELPERS_PATH",DOCROOT."Helpers/");
define("MODULES_PATH",DOCROOT."Modules/");

require_once DOCROOT."Core/bootload.php";

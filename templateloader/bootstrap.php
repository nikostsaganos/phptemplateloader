<?php 

mb_internal_encoding("UTF-8");
error_reporting(E_ALL ^ E_NOTICE);

define('TEMPLATELOADER_ROOT', dirname(__FILE__)); 
define('ROOT', dirname(dirname(__FILE__))); 

require_once(TEMPLATELOADER_ROOT.'/TemplateLoader.php');
$config = include(TEMPLATELOADER_ROOT.'/config.php');

$templateLoader = new TemplateLoader($config);
$templateLoader->run();
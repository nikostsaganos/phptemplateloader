<?php 

mb_internal_encoding("UTF-8");
error_reporting(E_ALL ^ E_NOTICE);

define('ROOT', dirname(dirname(__FILE__))); 

require_once('TemplateLoader.php');
$config = require_once('config.php');

$templateLoader = new TemplateLoader($config);
$templateLoader->run();
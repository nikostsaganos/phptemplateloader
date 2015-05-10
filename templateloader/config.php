<?php 

return array(
    
    'template_engine'       => 'twig',      // twig or php 
    'templates_directory'   => 'templates', // a subdirectory or '' to use the root directory of the project
    'models_directory'      => 'models',    // where your YAML models are stored

    'autoload_models' => array(
        // add model names to autoload in every template first. eg. 'header' will autoload header.yaml
    ),

);
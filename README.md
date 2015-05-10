# Twig/PHP Template Loader

A simple script that allows you to render **Twig or plain PHP**  templates while manipulating sample data loaded from **YAML models**.

This can be useful for frontend developers that need to manipulate sample data within their templates before the template is used within a CMS. Or even a backend developer may provide realistic sample data to use in templating before having the backend ready.

## Installation

Just clone this repository or [download as .zip](https://github.com/nikostsaganos/phptemplateloader/archive/master.zip).


## Usage

The following structure is included:

    /projectdirectory
	    /models
	    /templates
	    /templateloader
	    index.php
	    .htaccess

By default you can store your **.html templates in /templates** and your **.yaml models in /models**. You can change these directories in **/templateloader/config.php**, or you can even use the root directory if you leave the corresponding config entries empty. 

In **/templateloader/config.php** you can also change the "template_engine" to "php" if you don't like to use twig. The script will then look for .php templates instead of .html.

#### Render a template with it's YAML model
The idea is that If you navigate to  	

	http://localhost/projectdirectory/index.php/sample 

the script will load  the  **templates/sample.html** twig template with the data from **models/sample.yaml** YAML model

### Render a template with different model name or multiple models

	http://localhost/projectdirectory/index.php/sample/foo/bar

will load **templates/sample.html** twig template with the data from **models/foo.yaml** and **models/bar.yaml** YAML model

#### Autoload common models to all templates

You may have some YAML models that hold general data shared along all your templates (e.g. the navigation data, the site's name etc). To autoload this models without adding them as URL parameters edit **/templateloader/config.php** and add them in "**autoload_models**" like this:

	'autoload_models' => array(
        'common',
        'header'
    ),

#### Apache mod_rewrite 

An .htaccess is included, so if you have apache with mod_rewrite enabled you can ommit the **index.php** part. For example:

	http://localhost/projectdirectory/index.php/sample
	
can change to:

	http://localhost/projectdirectory/sample


--- 

This script includes/uses the [Twig](https://github.com/twigphp/Twig) library for template rendering and the [Spyc](https://github.com/mustangostang/spyc/) library for YAML parsing.

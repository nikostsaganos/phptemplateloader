# Twig/PHP Template Loader

A simple script that allows you to render **Twig or plain PHP**  templates while manipulating sample data loaded from **YAML models**.

## Installation

Just clone this repository or [download as .zip](https://github.com/nikostsaganos/phptemplateloader/archive/master.zip).


## Usage

The following structure is included by default:

    /projectdirectory
	    /models
	    /templates
	    /templateloader
	    index.php
	    .htaccess

By default you can store your **.html templates in /templates** and your **.yaml models in /models**. You can change these directories in **/templateloader/config.php**, or you can even use the root directory if you leave the corresponding config entries empty. 

In **/templateloader/config.php** you can also change the "template_engine" to "php" if you don't like to use twig. The script will then look for .php templates instead of .html.

### Load a template
The idea is that If you navigate to  	

	http://localhost/projectdirectory/index.php/sample 

the script will load  the  **templates/sample.html** twig template with the data from **models/sample.yaml** YAML model

### More examples

	http://localhost/projectdirectory/index.php/sample/foo/bar

will load **templates/sample.html** twig template with the data from **models/foo.yaml** and **models/bar.yaml** YAML model


### Apache mod_rewrite 

An .htaccess is included, so if you have apache with mod_reqwrite enabled you can ommit the **index.php** part. For example:

	http://localhost/projectdirectory/index.php/sample
	
can change to:

	http://localhost/projectdirectory/sample



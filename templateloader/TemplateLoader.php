<?php 

/**
 * TemplateLoader
 * 
 * A simple script that allows you to render Twig (or plain PHP) templates 
 * while manipulating sample data loaded from YAML models
 *
 * @author Nikos Tsaganos <tsag99@gmail.com>
 * @copyright Copyright 2015 Nikos Tsaganos
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 * @version 1.0
 */

class TemplateLoader {

    private $twig;
    private $path = '';
    private $route = array();
    private $templateFile = '';
    private $modelFiles = array();
    private $settings = array();

    public function __construct($config = array()) {

        $this->settings = $config + array(
            'template_engine'       => 'twig', 
            'templates_directory'   => 'templates',
            'models_directory'      => 'models',
            'autoload_models' => array(),
        ); 

        if ($_SERVER["PATH_INFO"]) {
            $this->path = $_SERVER["PATH_INFO"];
        }
        elseif ($_SERVER["REDIRECT_URL"]) {
            $this->path = $_SERVER["REDIRECT_URL"];
            $pathToRemove = dirname($_SERVER["PHP_SELF"]);
            if ($pathToRemove) {
                $this->path = preg_replace("|^".$pathToRemove."|i", "", $this->path);
            }
        }

        $this->path = preg_replace("|^/|i", "", $this->path);

        $this->route = explode('/', $this->path);

        // Yaml parser
        require_once('vendor/Spyc/Spyc.php');

        // Twig parser
        require_once('vendor/Twig/Autoloader.php');
        Twig_Autoloader::register();

        $loader = new Twig_Loader_Filesystem(ROOT.'/'.$this->settings['templates_directory']);
        $this->twig = new Twig_Environment($loader);

    }

    public function setTemplateFile($file = '') {
        if (!$file) {
            return;
        }

        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION)); 
        if (!$ext) {
            if ($this->settings['template_engine'] == 'twig') {
                $file .= '.html';
            }
            else {
                $file .= '.php';
            }
        }

        $this->templateFile = $file;
    }

    public function setModelFile($file = '') {
        if (!$file) {
            return;
        }

        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION)); 
        if (!$ext) {
            $file .= '.yml';
        }

        $this->modelFiles[] = $file;
    }

    public function render() {
        
        if (!$this->templateFile) {
            return;
        }

        $data = array();
        foreach ($this->modelFiles as $modelFile) {
            $file = ROOT.'/'.$this->settings['models_directory'].'/'.$modelFile;
            if (is_file($file)) {
                $loadedData = Spyc::YAMLLoad($file);
                $data = $data + $loadedData;
            }
        }

        if ($this->settings['template_engine'] == 'twig') {
            echo $this->twig->render($this->templateFile, $data);
        }
        else {
            extract($data);
            include(ROOT.'/'.$this->settings['templates_directory'].'/'.$this->templateFile);
        }

    }

    public function run() {

        if (!$this->route[0]) {
            echo 'No template selected.';
            return;
        }

        $this->setTemplateFile($this->route[0]);

        // autoloader models
        foreach ($this->settings['autoload_models'] as $key => $value) {
            $this->setModelFile($value);
        }

        // if a second parameter is set, load that model and all the next
        if ($this->route[1]) {
            foreach ($this->route as $key => $value) {
                if ($key==0) continue;
                $this->setModelFile($value);
            }
        }
        // else load the model with the same name as the template
        else {
            $this->setModelFile($this->route[0]);
        }

        $this->render();
    }

}
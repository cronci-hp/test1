<?php

/*
 * Copyright ViksTech di Vittorio Domenico Padiglia.
 * Se non hai pagato per l'uso o la modifica di questi sorgenti, hai il dovere di cancellarli
 * Il possesso e l'uso o la copia di questo codice non consentito è punibile per legge..
 */

namespace core;

// include ControllerConfig Object
require_once CORE . 'controllerConfig.php';
// include ControllerData Object
require_once CORE . 'controllerData.php';

class Controller {

    /**
     * @var string $controllerName Will contain the Controller Name
     */
    private $controllerName;

    /**
     * @var \core\controllerConfig|\controller\*Config| $config Will contain the Controller Config
     *
     * @var \core\controllerData|\controller\*Data| $data Will contain the Controller Data Wrapper
     */
    public $config, $data;

    public function __construct() {
        // get Controller Name by the name of the object that extends this class
        $this->controllerName = explode('\\', get_class($this))[1];
        // load configurations file
        $this->loadConfig();
        // load right data wrapper file
        $this->loadDataWrapper();
    }

    /**
     * Will load the Controller Configuration File, if it is present. Otherwise will load dummy class
     *
     */
    private function loadConfig() {
        $file = CONTROLLER . "{$this->controllerName}/{$this->controllerName}.config.php";
        if (file_exists($file)) {
            require_once $file;
            $className = "\\controller\\{$this->controllerName}Config";
            // Create istance of right controller config
            $this->config = new $className();
        } else
        // Create Dummy Config Object
            $this->config = new \core\ControllerConfig();
    }

    /**
     * Will load the Controller Data Wrapper File, if it is present. Otherwise will load dummy class
     *
     */
    private function loadDataWrapper() {
        if ($this->config->dataSource) {
            $file = CONTROLLER . "{$this->controllerName}/{$this->controllerName}.{$this->config->dataSource}.php";
            if (file_exists($file)) {
                require_once $file;
                $className = "\\controller\\{$this->controllerName}{$this->config->dataSource}";
                // Create istance of right controller data wrapper

                $this->data = new $className();
                return;
            }
        }
        // Create Dummy Data Object

        $this->data = new \core\ControllerData();
    }

}

<?php

/*
 * Copyright ViksTech di Vittorio Domenico Padiglia.
 * Se non hai pagato per l'uso o la modifica di questi sorgenti, hai il dovere di cancellarli
 * Il possesso e l'uso o la copia di questo codice non consentito è punibile per legge..
 */

namespace core;

class ControllerConfig {

    /**
     * @var string $dataSource will contain the configuration of Data Wrapper 
     * @example csv, mysql, postgres, etc will drive the Controller to use one or another wrapper to get external data
     */
    public $dataSource = null;

    /**
     * Magic Method Override. Will check if properties exixts in the extended Controller, then return it or Null
     * @var string $name
     */
    public function __get($name) {
        if (!property_exists($this, $name))
            return null;
        return $this->$name;
    }

    /**
     * Magic Method Override. Will check if methods exixts in the extended Controller, then return it or Null
     * @var string $name
     * @var mixed $arguments
     */
    public function __call($name, $arguments) {
        if (!method_exists($this, $name) && is_callable(array($this, $name)))
            return null;
        call_user_func(array($this, $name));
    }

}

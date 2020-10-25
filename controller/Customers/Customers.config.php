<?php

/*
 * Copyright ViksTech di Vittorio Domenico Padiglia.
 * Se non hai pagato per l'uso o la modifica di questi sorgenti, hai il dovere di cancellarli
 * Il possesso e l'uso o la copia di questo codice non consentito è punibile per legge..
 */

namespace controller;

require_once(CORE . 'controllerConfig.php');

use core;

class CustomersConfig extends \core\ControllerConfig {

    public $dataSource = 'csv';

}

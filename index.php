<?php

/*
 * Copyright ViksTech di Vittorio Domenico Padiglia.
 * Se non hai pagato per l'uso o la modifica di questi sorgenti, hai il dovere di cancellarli
 * Il possesso e l'uso, o la copia, di questo codice non consentito è punibile per legge.
 */

require 'report.php';
try {
    $app = new app();
    $outputType = $argv[2] ?? 'plain';
    echo $app->dispatch($outputType);
} catch (Exception $ex) {
    if (DEBUG) {
        echo 'ERROR : ' . $ex->getMessage() . "\n";
    }
}
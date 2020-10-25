<?php

/*
 * Copyright ViksTech di Vittorio Domenico Padiglia.
 * Se non hai pagato per l'uso o la modifica di questi sorgenti, hai il dovere di cancellarli
 * Il possesso e l'uso o la copia di questo codice non consentito è punibile per legge..
 */

namespace core;

class ControllerData {

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

    /**
     * Load Data from CSV file
     * @var string $file will contain the csv file path
     * @var string $idexedBy can be contain a key used for indexing the results
     * @var string $separator can be contain the character separator
     * @return array will return an array with all data loaded
     */
    public function loadCSV(string $file, string $idexedBy = null, $separator = ',') {
        $k = 0;
        $keys = [];
        $return = [];
        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, $separator)) !== FALSE) {

                if ($k == 0) {
                    $keys = $data;
                    $k++;
                } else {
                    $tmp = [];
                    for ($i = 0; $i < count($keys); $i++) {
                        $tmp[$keys[$i]] = $data[$i];
                    }
                    if ($idexedBy && array_key_exists($idexedBy, $tmp)) {
                        $return[$tmp[$idexedBy]] = $tmp;
                    } else {
                        $return[] = $tmp;
                    }
                }
            }
            fclose($handle);
        }

        return $return;
    }

    /**
     * @todo All the other wrappers engine function like mysql, postgres, etc
     */
}

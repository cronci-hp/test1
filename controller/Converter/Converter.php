<?php

/*
 * Copyright ViksTech di Vittorio Domenico Padiglia.
 * Se non hai pagato per l'uso o la modifica di questi sorgenti, hai il dovere di cancellarli
 * Il possesso e l'uso o la copia di questo codice non consentito è punibile per legge..
 */

namespace controller;

require_once CORE . 'controller.php';

use \core\Controller;

class Converter extends Controller {

    public function __construct() {
        // call parent constructor to initialize propereties, config and data wrapper engine
        parent::__construct();
    }

    public function callAPi(string $from, string $to) {
        $fromto = "{$from}_{$to}";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://free.currconv.com/api/v7/convert?q=$fromto&compact=ultra&apiKey=09ed2971fdb0906c743f");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($output, 1);
        if ($data && is_array($data) && array_key_exists($fromto, $data))
            return (float) $data[$fromto];
        return null;
    }

    public function convert(string $val) {
        $re = '/([\D^]+)([\d\.]+)/m';
        preg_match_all($re, $val, $matches, PREG_SET_ORDER, 0);
        $from = $matches[0][1];
        $val = $matches[0][2];
        switch ($from) {
            case '€':
                return $val;
            case '$':
                $from = 'USD';
                break;
            case '£':
                $from = 'GBP';
                break;
            default:
                return null;
        }

        $to = 'EUR';
        $conversionTax = $this->callAPi($from, $to);
        if ($conversionTax == null) {
            return null;
        }

        return (float) $val * $conversionTax;
    }

}

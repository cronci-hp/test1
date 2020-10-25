<?php

/*
 * Copyright ViksTech di Vittorio Domenico Padiglia.
 * Se non hai pagato per l'uso o la modifica di questi sorgenti, hai il dovere di cancellarli
 * Il possesso e l'uso o la copia di questo codice non consentito è punibile per legge..
 */

namespace controller;

require_once(CORE . 'controllerData.php');

use core;

class Customerscsv extends \core\ControllerData {

    /**
     * @var string $file contain the customers data path
     */
    private $file = DATA . 'customers.csv';

    /**
     * @var string $fileTransactions contain the customers transactions data path
     */
    private $fileTransactions = DATA . 'customersTransactions.csv';

    /**
     * Find the customer in the CSV file
     * @var int $id will contain the customer required id
     * @return array|null will return the customer data if present in CSV file
     */
    public function getCustomer($id) {
        $data = $this->getCustomers();
        if (array_key_exists($id, $data))
            return $data[$id];
        return null;
    }

    /**
     * Retrive all the customers data from the CSV file
     * @return array|null will return the customers data from CSV file
     */
    public function getCustomers() {
        return $this->loadCSV($this->file, 'id');
    }

    /**
     * Just for debug. Create a dummy Customers file.
     */
    public function createDummyData() {
        $fp = fopen($this->file, 'w+');
        $data = [
            ['name' => 'Pippo', 'surname' => 'SurPippo', 'id' => 1],
            ['name' => 'Pluto', 'surname' => 'SurPluto', 'id' => 2],
            ['name' => 'Baudo', 'surname' => 'SurBaudo', 'id' => 3],
            ['name' => 'Mike', 'surname' => 'SurMike', 'id' => 4],
        ];
        fputcsv($fp, array_keys($data[0]));
        foreach ($data as $v)
            fputcsv($fp, $v);
        fclose($fp);
    }

    /**
     * Find the customer transactions in the CSV file
     * @var int $id will contain the customer required id
     * @return array|null will return the customer transactions data if present in CSV file
     */
    public function getCustomerTransactions($id) {
        $data = $this->getCustomersTransactions();

        $return = [];
        foreach ($data as $v) {
            if ($v['customer'] == $id)
                $return[] = $v;
        }
        return $return;
    }

    /**
     * Retrive all the customers transactions data from the CSV file
     * @return array|null will return the customers transactions data from CSV file
     */
    public function getCustomersTransactions() {
        return $this->loadCSV($this->fileTransactions, null, ';');
    }

}

<?php

/*
 * Copyright ViksTech di Vittorio Domenico Padiglia.
 * Se non hai pagato per l'uso o la modifica di questi sorgenti, hai il dovere di cancellarli
 * Il possesso e l'uso o la copia di questo codice non consentito è punibile per legge..
 */

namespace controller;

require_once  CORE . 'controller.php';
require_once  MODEL . 'Customer.php';

use \model\Customer;
use \core\Controller;

class Customers extends Controller {

    public function __construct() {
        // call parent constructor to initialize propereties, config and data wrapper engine
        parent::__construct();
    }

    /**
     * Find the customer from the Data Engine and create an istance of model\Customer
     * @var int $id will contain the customer required id
     * @return model\Customer|null will return  model\Customer or null if can't find it in data engine
     */
    public function getCustomer(int $id) {
        // retrive Customer Data
        $customerData = $this->getCustomerData($id);
        if (!$customerData)
            return null;
        // retrive Customer's Transactions
        $customerTransactionsData = $this->getCustomerTransactionData($id);
        // create and return model\Customer instance
        return new Customer($customerData, $customerTransactionsData);
    }

    /**
     * get Cusomer Data by id
     * @var int $id will contain the customer required id
     * @return array|null will return customer data if it's present in Data Engine
     */
    private function getCustomerData(int $id) {
        //    $this->data->createDummyData();
        return $this->data->getCustomer($id);
    }

    /**
     * Find the customer transactions from the Data Engine by id
     * @var int $id will contain the customer required id
     * @return array|null will return customer transactions data if it's present in Data Engine
     */
    private function getCustomerTransactionData(int $id) {
        return $this->data->getCustomerTransactions($id);
    }

}

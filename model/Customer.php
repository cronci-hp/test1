<?php

/*
 * Copyright ViksTech di Vittorio Domenico Padiglia.
 * Se non hai pagato per l'uso o la modifica di questi sorgenti, hai il dovere di cancellarli
 * Il possesso e l'uso, o la copia, di questo codice non consentito è punibile per legge.
 */

namespace model;

class Customer {

    /**
     * @var bool $init Check if the customer is good initialized
     */
    private $init = false;

    /**
     * @var array $keys Will contain the Customer's "property" 
     */
    private $keys = ['name', 'surname', 'id'];

    /**
     * @var array $transactions Will contain the Customer's transactions
     */
    private $transactions = [];

    /**
     * Will Init the Customer Object.
     *
     * @param array $data Contain an array with all Customer Data
     *      
     * @param array $transactions Contain an array with all Customer Transactions
     *      
     * @todo check transaction input param 
     */
    public function __construct(array $data, array $transactions = null) {
        // The Customer Object can be populated only if there are some data in $data param
        if (!$data)
            return;
        // Populate Customer Object Properties with the enabled data 
        foreach ($this->keys as $k) {
            $this->$k = $data[$k] ?? null;
        }
        // init transactions
        $this->transactions = $transactions;
        // set Customer as Initialized
        $this->init = true;
    }

    /**
     * Will return true if the Customer Object is Initialized.
     *
     * @return bool.
     */
    public function isInit() {
        return $this->init;
    }

    /**
     * Will return the Customer Name if the object is initialized.
     *
     * @return string|null.
     */
    public function getName() {
        return ($this->isInit()) ? $this->name : null;
    }

    /**
     * Will return the Customer Surname if the object is initialized.
     *
     * @return string|null.
     */
    public function getSurname() {
        return ($this->isInit()) ? $this->surname : null;
    }

    /**
     * Will return the Customer ID if the object is initialized.
     *
     * @return int|null.
     */
    public function getId() {
        return ($this->isInit()) ? $this->id : null;
    }

    /**
     * Will return the Customer Transactions if the object is initialized.
     *
     * @return array|null.
     */
    public function getTransactions() {
        if (!$this->isInit()) {
            return null;
        }
        return $this->transactions;
    }

}

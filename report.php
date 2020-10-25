<?php

/*
 * Copyright ViksTech di Vittorio Domenico Padiglia.
 * Se non hai pagato per l'uso o la modifica di questi sorgenti, hai il dovere di cancellarli
 * Il possesso e l'uso, o la copia, di questo codice non consentito è punibile per legge.
 */
/**
 * @var bool DEBUG if True enable Error Print
 */
define('DEBUG', true);
/**
 * @var string CONTROLLER Controller absolute PATH
 */
define('CONTROLLER', __DIR__ . '/controller/');
/**
 * @var string MODEL Modelabsolute PATH
 */
define('MODEL', __DIR__ . '/model/');
/**
 * @var string CORE Core absolute PATH
 */
define('CORE', __DIR__ . '/core/');
/**
 * @var string DATA Data absolute PATH
 */
define('DATA', __DIR__ . '/data/');

class app {

    /**
     * @var int $customerId will contain the customer ID passed by client args
     */
    private $customerId;

    /**
     * @var int $customersController will be instance of Customers, the customers controller
     */
    private $customersController;

    public function __construct() {
        
    }

    /**
     * Dispatch actions.
     *
     * @param string $action Name of the needed action.
     */
    public function dispatch(string $action) {
        // Init $customerId or exit
        if ($this->initCustomerId() == null)
            return null;
        // Load Customers controller or exit
        if (!$this->loadController('Customers'))
            return null;
        $this->customersController = new \controller\Customers();
        // Load Customer Data By ID, Customer will be Null or \model\Customer object
        $customer = $this->loadCustomerData();
        // Get Customer Transactions
        $transactions = $customer->getTransactions();

        // Load Customers controller or exit
        if (!$this->loadController('Converter'))
            return null;
        // Create a Converter Instance
        $converter = new \controller\Converter();
        foreach ($transactions as $k => $transaction) {
            // Get the converted value
            $transactions[$k]['valueConverted'] = $converter->convert($transaction['value']);
        }
        switch ($action) {
            case 'plain':
            default:
                if (!count($transactions)) {
                    return "No transaction for that customer {$this->customerId}\n";
                }
                $txt = sprintf('There are %d transactions for Customer [%d] %s %s', count($transactions), $customer->getId(), $customer->getName(), $customer->getSurname()) . "\n";
                foreach ($transactions as $transaction) {
                    $txt .= implode(' ', $transaction) . "\n";
                }
                return $txt;
                break;

            case 'json':
                return json_encode($transactions);
                break;
        }
    }

    /**
     * Load required Controller.
     *
     * @param string $controllerName Name of controller.
     *
     * @return bool will return true on Controller file loaded.
     */
    public function loadController(string $controllerName) {
        $file = CONTROLLER . "$controllerName/$controllerName.php";
        // Check if file exists, otherwise create exception
        if (!file_exists($file)) {
            throw new Exception("Controller $controllerName not found in $file");
            return;
        }
        // Require the controller file 
        return require_once $file;
    }

    /**
     * Will Load customer data by $customerId value.
     *
     * @return model\Customer|null Returns null or the Customer Object.
     */
    public function loadCustomerData() {
        return $this->customersController->getCustomer($this->customerId);
    }

    /**
     * Will Get Customer ID from PHP Cli ARGS.
     *
     * @return int|bool Returns and set the customer ID.
     */
    public function initCustomerId() {
        global $argv;

        if (($this->customerId = $argv[1] ?? null) === null) {
            throw new Exception('No ID provided');
            return false;
        }
        if (!is_numeric($this->customerId)) {
            throw new Exception('No Valid ID provided');
            return false;
        }

        return $this->customerId;
    }

}

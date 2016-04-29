<?php

namespace BillAgain;

use BillAgain\Curl;

/**
 * Customers.
 * 
 * Main class for dealing with Customers
 * 
 * @link http://docs.billagain.com/developer/customers
 * @version 1.0.1
 * @license GPL
 * @author Mark Duppa-Whyte <mark@keymedia.co.za>
 * 
 */
class Customers extends Curl {

    /**
     * The unique Id set for individual customer
     * @var integer customer_id
     */
    protected $customer_id;

    /**
     * Lists all the customers
     * Calls the initCurl method without extra parameters
     */
    public function listCustomers() {
        $this->initCurl();
        return $this;
    }

    /**
     * Get the customer details of a given Id
     * @param integer $customer_id
     */
    public function getCustomer($customer_id) {
        if (gettype($customer_id) == 'integer') {
            $this->customer_id = $customer_id;
            $this->type = 'GET';
            $this->url = '/customers/' . $this->customer_id;
            $this->initCurl();
        } else {
            $this->error = 'Customer Id is not an integer value';
        }
        return $this;
    }

    /**
     * This adds a customer via POST method, data is inserted as an array
     * 
     * Please check API documentation for required fields
     * 
     * @param array $data
     */
    public function addCustomer($data = array()) {
        $this->setData($data);
        if ($this->error == '') {
            $this->type = 'POST';
            $this->initCurl();
        }
        return $this;
    }

    /**
     * Edit Customer, passing through data in an array format
     * 
     * @param integer $customer_id
     * @param array $data
     * @return \BillAgain\Customers
     */
    public function editCustomer($customer_id, $data = array()) {
        if (gettype($customer_id) == 'integer') {
            $this->customer_id = $customer_id;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'PUT';
                $this->url = '/customers/' . $this->customer_id;
                $this->initCurl();
            }
        }
        return $this;
    }

    /**
     * Delete Customer
     * 
     * @param integer $customer_id
     * @return \BillAgain\Customers
     */
    public function deleteCustomer($customer_id) {
        if (gettype($customer_id) == 'integer') {
            $this->customer_id = $customer_id;
            $this->type = 'DELETE';
            $this->url = '/customers/' . $this->customer_id;
            $this->initCurl();
        } else {
            $this->error = 'Customer Id is not an integer value';
        }
        return $this;
    }
    
    /**
     * Archive Customer
     * 
     * @param integer $customer_id
     * @return \BillAgain\Customers
     */
    public function archiveCustomer($customer_id) {
        if (gettype($customer_id) == 'integer') {
            $this->customer_id = $customer_id;
            $this->type = 'PUT';
            $this->url = '/customers/' . $this->customer_id . '/archive';
            $this->initCurl();
        } else {
            $this->error = 'Customer Id is not an integer value';
        }
        return $this;
    }
    
    /**
     * Reopen Customer
     * 
     * @param integer $customer_id
     * @return \BillAgain\Customers
     */
    public function reopenCustomer($customer_id) {
        if (gettype($customer_id) == 'integer') {
            $this->customer_id = $customer_id;
            $this->type = 'PUT';
            $this->url = '/customers/' . $this->customer_id . '/reopen';
            $this->initCurl();
        } else {
            $this->error = 'Customer Id is not an integer value';
        }
        return $this;
    }

}

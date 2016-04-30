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
     * @var integer $customerId
     */
    protected $customerId;

    /**
     * Returns a list off all the Customers linked to the logged in account, subject to paging as defined in pagination section
     * 
     */
    public function listCustomers() {
        $this->initCurl();
        return $this;
    }

    /**
     * Returns a specific customer
     * 
     * @param integer $customerId
     */
    public function getCustomer($customerId) {
        if (gettype($customerId) == 'integer') {
            $this->customerId = $customerId;
            $this->type = 'GET';
            $this->url = '/customers/' . $this->customerId;
            $this->initCurl();
        } else {
            $this->error = 'Customer ID is not an integer value';
        }
        return $this;
    }

    /**
     * Adds a customer to your account
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
     * Edits a specific customer details
     * Please check API documentation for required fields
     * 
     * @param integer $customerId
     * @param array $data
     * @return \BillAgain\Customers
     */
    public function editCustomer($customerId, $data = array()) {
        if (gettype($customerId) == 'integer') {
            $this->customerId = $customerId;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'PUT';
                $this->url = '/customers/' . $this->customerId;
                $this->initCurl();
            }
        } else {
            $this->error = 'Customer ID is not an integer value';
        }
        return $this;
    }

    /**
     * Delete a customer from your account
     * 
     * @param integer $customerId
     * @return \BillAgain\Customers
     */
    public function deleteCustomer($customerId) {
        if (gettype($customerId) == 'integer') {
            $this->customerId = $customerId;
            $this->type = 'DELETE';
            $this->url = '/customers/' . $this->customerId;
            $this->initCurl();
        } else {
            $this->error = 'Customer ID is not an integer value';
        }
        return $this;
    }

    /**
     * Archive a customer from your account
     * 
     * @param integer $customerId
     * @return \BillAgain\Customers
     */
    public function archiveCustomer($customerId) {
        if (gettype($customerId) == 'integer') {
            $this->customerId = $customerId;
            $this->type = 'PUT';
            $this->url = '/customers/' . $this->customerId . '/archive';
            $this->initCurl();
        } else {
            $this->error = 'Customer ID is not an integer value';
        }
        return $this;
    }

    /**
     * Reopen a customer from your account
     * 
     * @param integer $customerId
     * @return \BillAgain\Customers
     */
    public function reopenCustomer($customerId) {
        if (gettype($customerId) == 'integer') {
            $this->customerId = $customerId;
            $this->type = 'PUT';
            $this->url = '/customers/' . $this->customerId . '/reopen';
            $this->initCurl();
        } else {
            $this->error = 'Customer ID is not an integer value';
        }
        return $this;
    }

}

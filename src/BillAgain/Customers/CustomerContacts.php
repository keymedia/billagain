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
class CustomerContacts extends Curl {

    /**
     * @var integer $customerId
     */
    protected $customerId;
    
    /**
     * @var integer $customerContactId
     */
    protected $customerContactId;
    
    /**
     * Returns a list off all customer contacts linked to this customerID which is linked to the logged in account
     * 
     * @param integer $customerId
     */
    public function listByCustomer($customerId) {
        if (gettype($customerId) == 'integer') {
            $this->customerId = $customerId;
            $this->type = 'GET';
            $this->url = '/customers/' . $this->customerId . '/contacts';
            $this->initCurl();
        } else {
            $this->error = 'Customer ID is not an integer value';
        }
        return $this;
    }

    /**
     * Returns a list off all customer contacts linked to the logged in account
     * 
     */
    public function listCustomerContacts() {
        $this->type = 'GET';
        $this->url = '/customercontacts';
        $this->initCurl();
        return $this;
    }

    /**
     * Returns a specific customer contact
     * 
     * @param integer $customerContactId
     */
    public function getCustomerContacts($customerContactId) {
        if (gettype($customerContactId) == 'integer') {
            $this->customerContactId = $customerContactId;
            $this->type = 'GET';
            $this->url = '/customercontacts/' . $this->customerContactId;
            $this->initCurl();
        } else {
            $this->error = 'Customer Contact ID is not an integer value';
        }
        return $this;
    }

    /**
     * Adds a customer contact to the customer which is linked to your account
     * Please check API documentation for required fields
     * 
     * @param array $data
     */
    public function addCustomerContact($data = array()) {
        $this->setData($data);
        if ($this->error == '') {
            $this->type = 'POST';
            $this->url = '/customercontacts';
            $this->initCurl();
        }
        return $this;
    }

    /**
     * Edits a customer's contact linked to your account
     * Please check API documentation for required fields
     * 
     * @param integer $customerContactId
     * @param array $data
     * @return \BillAgain\Customers
     */
    public function editCustomerContact($customerContactId, $data = array()) {
        if (gettype($customerContactId) == 'integer') {
            $this->customerContactId = $customerContactId;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'PUT';
                $this->url = '/customercontacts/' . $this->customerContactId;
                $this->initCurl();
            }
        } else {
            $this->error = 'Customer Contact ID is not an integer value';
        }
        return $this;
    }

    /**
     * Delete a customer contact from your account
     * 
     * @param integer $customerContactId
     * @return \BillAgain\Customers
     */
    public function deleteCustomerContact($customerContactId) {
        if (gettype($customerContactId) == 'integer') {
            $this->customerContactId = $customerContactId;
            $this->type = 'DELETE';
            $this->url = '/customercontacts/' . $this->customerContactId;
            $this->initCurl();
        } else {
            $this->error = 'Customer Contact ID is not an integer value';
        }
        return $this;
    }

}

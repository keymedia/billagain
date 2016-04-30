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
class CustomerNotes extends Curl {

    /**
     * @var integer $customerId
     */
    protected $customerId;

    /**
     * @var integer $customerNoteId
     */
    protected $customerNoteId;

    /**
     * Returns a list off all customer notes linked to this customerID which is linked to the logged in account
     * 
     * @param integer $customerId
     */
    public function listByCustomer($customerId) {
        if (gettype($customerId) == 'integer') {
            $this->customerId = $customerId;
            $this->type = 'GET';
            $this->url = '/customers/' . $this->customerId . '/customernotes';
            $this->initCurl();
        } else {
            $this->error = 'Customer ID is not an integer value';
        }
        return $this;
    }

    /**
     * Returns a list off all customer notes linked to the logged in account
     * 
     */
    public function listCustomerNotes() {
        $this->type = 'GET';
        $this->url = '/customernotes';
        $this->initCurl();
        return $this;
    }

    /**
     * Returns a specific customer note
     * 
     * @param integer $customerNoteId
     */
    public function getCustomerNotes($customerNoteId) {
        if (gettype($customerNoteId) == 'integer') {
            $this->customerNoteId = $customerNoteId;
            $this->type = 'GET';
            $this->url = '/customernotes/' . $this->customerNoteId;
            $this->initCurl();
        } else {
            $this->error = 'Customer Note ID is not an integer value';
        }
        return $this;
    }

    /**
     * Adds a customer note to the customer which is linked to your account
     * Please check API documentation for required fields
     * 
     * @param array $data
     */
    public function addCustomerNote($data = array()) {
        $this->setData($data);
        if ($this->error == '') {
            $this->type = 'POST';
            $this->url = '/customernotes';
            $this->initCurl();
        }
        return $this;
    }

    /**
     * Edits a customer's note linked to your account
     * Please check API documentation for required fields
     * 
     * @param integer $customerNoteId
     * @param array $data
     * @return \BillAgain\Customers
     */
    public function editCustomerNote($customerNoteId, $data = array()) {
        if (gettype($customerNoteId) == 'integer') {
            $this->customerNoteId = $customerNoteId;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'PUT';
                $this->url = '/customernotes/' . $this->customerNoteId;
                $this->initCurl();
            }
        } else {
            $this->error = 'Customer Note ID is not an integer value';
        }
        return $this;
    }

    /**
     * Delete a customer note from your account
     * 
     * @param integer $customerNoteId
     * @return \BillAgain\Customers
     */
    public function deleteCustomerNote($customerNoteId) {
        if (gettype($customerNoteId) == 'integer') {
            $this->customerNoteId = $customerNoteId;
            $this->type = 'DELETE';
            $this->url = '/customernotes/' . $this->customerNoteId;
            $this->initCurl();
        } else {
            $this->error = 'Customer Note ID is not an integer value';
        }
        return $this;
    }

}

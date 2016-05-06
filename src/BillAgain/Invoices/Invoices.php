<?php

namespace BillAgain\Invoices;

use BillAgain\Curl;

/**
 * Invoices.
 * 
 * Main class for dealing with Invoices
 * 
 * @link http://docs.billagain.com/developer/invoices
 * @version 1.0.1
 * @license GPL
 * @author Mark Duppa-Whyte <mark@keymedia.co.za>
 * 
 */
class Invoices extends Curl {

    /**
     * @var integer $customerId
     */
    protected $customerId;

    /**
     * @var integer $invoiceId
     */
    protected $invoiceId;

    /**
     * Returns a list of Invoices linked to a specific customer, subject to paging as defined in pagination section
     * 
     * @param integer $customerId
     */
    public function listByCustomer($customerId) {
        if (gettype($customerId) == 'integer') {
            $this->customerId = $customerId;
            $this->type = 'GET';
            $this->url = '/customers/' . $this->customerId . '/invoices';
            $this->initCurl();
        } else {
            $this->error = 'Customer ID is not an integer value';
        }
        return $this;
    }

    /**
     * Returns a list of Invoices linked to this account, subject to paging as defined in pagination section
     * 
     */
    public function listInvoices() {
        $this->type = 'GET';
        $this->url = '/invoices';
        $this->initCurl();
        return $this;
    }

    /**
     * Returns a specific invoice
     * 
     * @param integer $invoiceId
     */
    public function getInvoices($invoiceId) {
        if (gettype($invoiceId) == 'integer') {
            $this->invoiceId = $invoiceId;
            $this->type = 'GET';
            $this->url = '/invoices/' . $this->invoiceId;
            $this->initCurl();
        } else {
            $this->error = 'Invoice ID is not an integer value';
        }
        return $this;
    }

    /**
     * Adds an invoice to your account
     * Please check API documentation for required fields
     * 
     * @param array $data
     */
    public function addInvoice($data = array()) {
        $this->setData($data);
        if ($this->error == '') {
            $this->type = 'POST';
            $this->url = '/invoices';
            $this->initCurl();
        }
        return $this;
    }

    /**
     * Updates an invoice
     * Please check API documentation for required fields
     * 
     * @param integer $invoiceId
     * @param array $data
     * @return \BillAgain\Invoices
     */
    public function editInvoice($invoiceId, $data = array()) {
        if (gettype($invoiceId) == 'integer') {
            $this->invoiceId = $invoiceId;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'PUT';
                $this->url = '/invoices/' . $this->invoiceId;
                $this->initCurl();
            }
        } else {
            $this->error = 'Invoice ID is not an integer value';
        }
        return $this;
    }

    /**
     * Deletes a draft invoice, will cancel the invoice if invoice is not a draft invoice
     * 
     * @param integer $invoiceId
     * @return \BillAgain\Invoices
     */
    public function deleteInvoice($invoiceId) {
        if (gettype($invoiceId) == 'integer') {
            $this->invoiceId = $invoiceId;
            $this->type = 'DELETE';
            $this->url = '/invoices/' . $this->invoiceId;
            $this->initCurl();
        } else {
            $this->error = 'Invoice ID is not an integer value';
        }
        return $this;
    }

}

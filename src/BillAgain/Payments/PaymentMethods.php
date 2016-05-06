<?php

namespace BillAgain\Payments;

use BillAgain\Curl;

/**
 * PaymentMethods.
 * 
 * Main class for dealing with Payment Methods
 * 
 * @link http://docs.billagain.com/developer/payment-methods
 * @version 1.0.1
 * @license GPL
 * @author Mark Duppa-Whyte <mark@keymedia.co.za>
 * 
 */
class PaymentMethods extends Curl {

    /**
     * @var integer $customerId
     */
    protected $customerId;

    /**
     * @var integer $paymentMethodId
     */
    protected $paymentMethodId;

    /**
     * Get a list of payment methods customer related
     * 
     * @param integer $customerId
     */
    public function listByCustomer($customerId) {
        if (gettype($customerId) == 'integer') {
            $this->customerId = $customerId;
            $this->type = 'GET';
            $this->url = '/customers/' . $this->customerId . '/paymentmethods';
            $this->initCurl();
        } else {
            $this->error = 'Customer ID is not an integer value';
        }
        return $this;
    }

    /**
     * Get a list of payment methods
     * 
     */
    public function listPaymentMethods() {
        $this->type = 'GET';
        $this->url = '/paymentmethods';
        $this->initCurl();
        return $this;
    }

    /**
     * Get specific payment method
     * 
     * @param integer $paymentMethodId
     */
    public function getPaymentMethods($paymentMethodId) {
        if (gettype($paymentMethodId) == 'integer') {
            $this->paymentMethodId = $paymentMethodId;
            $this->type = 'GET';
            $this->url = '/paymentmethods/' . $this->paymentMethodId;
            $this->initCurl();
        } else {
            $this->error = 'Payment Method ID is not an integer value';
        }
        return $this;
    }

    /**
     * Add payment method - credit card
     * Please check API documentation for required fields
     * 
     * @param array $data
     */
    public function addCreditCard($data = array()) {
        $this->setData($data);
        if ($this->error == '') {
            $this->type = 'POST';
            $this->url = '/paymentmethods/creditcard';
            $this->initCurl();
        }
        return $this;
    }

    /**
     * Add a bank account
     * Please check API documentation for required fields
     * 
     * @param array $data
     */
    public function addBankAccount($data = array()) {
        $this->setData($data);
        if ($this->error == '') {
            $this->type = 'POST';
            $this->url = '/paymentmethods/bankaccount';
            $this->initCurl();
        }
        return $this;
    }

    /**
     * Set current payment method as primary
     * 
     * @param array $paymentMethodId
     */
    public function setPrimary($paymentMethodId) {
        if (gettype($paymentMethodId) == 'integer') {
            $this->paymentMethodId = $paymentMethodId;
            $this->type = 'PUT';
            $this->url = '/paymentmethods/' . $this->paymentMethodId . '/setprimary';
            $this->initCurl();
        } else {
            $this->error = 'Invoice ID is not an integer value';
        }
        return $this;
    }

    /**
     * Edit Bank Account
     * Please check API documentation for required fields
     * 
     * @param integer $paymentMethodId
     * @param array $data
     * @return \BillAgain\PaymentMethods
     */
    public function editBankAccount($paymentMethodId, $data = array()) {
        if (gettype($paymentMethodId) == 'integer') {
            $this->paymentMethodId = $paymentMethodId;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'PUT';
                $this->url = '/paymentmethods/bankaccount/' . $this->paymentMethodId;
                $this->initCurl();
            }
        } else {
            $this->error = 'Payment Method ID is not an integer value';
        }
        return $this;
    }

    /**
     * Delete specific Payment Method, Primary method can never be deleted.
     * 
     * @param integer $paymentMethodId
     * @return \BillAgain\PaymentMethods
     */
    public function deletePaymentMethod($paymentMethodId) {
        if (gettype($paymentMethodId) == 'integer') {
            $this->paymentMethodId = $paymentMethodId;
            $this->type = 'DELETE';
            $this->url = '/paymentmethods/' . $this->paymentMethodId;
            $this->initCurl();
        } else {
            $this->error = 'Payment Method ID is not an integer value';
        }
        return $this;
    }

}

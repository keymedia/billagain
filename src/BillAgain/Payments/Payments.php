<?php

namespace BillAgain;

use BillAgain\Curl;

/**
 * Payments.
 * 
 * Main class for dealing with Payments
 * 
 * @link http://docs.billagain.com/developer/payments
 * @version 1.0.1
 * @license GPL
 * @author Mark Duppa-Whyte <mark@keymedia.co.za>
 * 
 */
class Payments extends Curl {

    /**
     * @var integer $customerId
     */
    protected $customerId;

    /**
     * @var integer $paymentId
     */
    protected $paymentId;

    /**
     * Get a list of payments customer related
     * 
     * @param integer $customerId
     */
    public function listByCustomer($customerId) {
        if (gettype($customerId) == 'integer') {
            $this->customerId = $customerId;
            $this->type = 'GET';
            $this->url = '/customers/' . $this->customerId . '/payments';
            $this->initCurl();
        } else {
            $this->error = 'Customer ID is not an integer value';
        }
        return $this;
    }

    /**
     * Get a list of payments account related
     * 
     */
    public function listPayments() {
        $this->type = 'GET';
        $this->url = '/payments';
        $this->initCurl();
        return $this;
    }

    /**
     * Get specific payment
     * 
     * @param integer $paymentId
     */
    public function getPayment($paymentId) {
        if (gettype($paymentId) == 'integer') {
            $this->paymentId = $paymentId;
            $this->type = 'GET';
            $this->url = '/payments/' . $this->paymentId;
            $this->initCurl();
        } else {
            $this->error = 'Payment ID is not an integer value';
        }
        return $this;
    }

    /**
     * Add specific payment
     * Please check API documentation for required fields
     * 
     * @param array $data
     */
    public function addPayment($data = array()) {
        $this->setData($data);
        if ($this->error == '') {
            $this->type = 'POST';
            $this->url = '/payments';
            $this->initCurl();
        }
        return $this;
    }

    /**
     * Edit specific payment
     * Please check API documentation for required fields
     * 
     * @param integer $paymentId
     * @param array $data
     * @return \BillAgain\Payments
     */
    public function editPayment($paymentId, $data = array()) {
        if (gettype($paymentId) == 'integer') {
            $this->paymentId = $paymentId;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'PUT';
                $this->url = '/payments/' . $this->paymentId;
                $this->initCurl();
            }
        } else {
            $this->error = 'Payment ID is not an integer value';
        }
        return $this;
    }

    /**
     * Delete specific payment
     * 
     * @param integer $paymentId
     * @return \BillAgain\Payments
     */
    public function deletePayment($paymentId) {
        if (gettype($paymentId) == 'integer') {
            $this->paymentId = $paymentId;
            $this->type = 'DELETE';
            $this->url = '/payments/' . $this->paymentId;
            $this->initCurl();
        } else {
            $this->error = 'Payment ID is not an integer value';
        }
        return $this;
    }

}

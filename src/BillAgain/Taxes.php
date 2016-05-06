<?php

namespace BillAgain;

use BillAgain\Curl;

/**
 * Taxes.
 * 
 * Main class for dealing with Taxes
 * 
 * @link http://docs.billagain.com/developer/taxes
 * @version 1.0.1
 * @license GPL
 * @author Mark Duppa-Whyte <mark@keymedia.co.za>
 * 
 */
class Taxes extends Curl {

    /**
     * @var integer $taxId
     */
    protected $taxId;

    /**
     * Returns a list off all the tax settings linked to the logged in account
     * 
     */
    public function listTaxes() {
        $this->type = 'GET';
        $this->url = '/tax';
        $this->initCurl();
        return $this;
    }

    /**
     * Returns a specific tax setting
     * 
     * @param integer $taxId
     */
    public function getTax($taxId) {
        if (gettype($taxId) == 'integer') {
            $this->taxId = $taxId;
            $this->type = 'GET';
            $this->url = '/tax/' . $this->taxId;
            $this->initCurl();
        } else {
            $this->error = 'Tax ID is not an integer value';
        }
        return $this;
    }

    /**
     * Adds a tax setting to your account
     * Please check API documentation for required fields
     * 
     * @param array $data
     */
    public function addTax($data = array()) {
        $this->setData($data);
        if ($this->error == '') {
            $this->type = 'POST';
            $this->url = '/tax';
            $this->initCurl();
        }
        return $this;
    }

    /**
     * Edits a specific tax setting
     * Please check API documentation for required fields
     * 
     * @param integer $taxId
     * @param array $data
     * @return \BillAgain\Taxes
     */
    public function editTax($taxId, $data = array()) {
        if (gettype($taxId) == 'integer') {
            $this->taxId = $taxId;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'PUT';
                $this->url = '/tax/' . $this->taxId;
                $this->initCurl();
            }
        } else {
            $this->error = 'Tax ID is not an integer value';
        }
        return $this;
    }

    /**
     * Delete a tax setting in your account
     * 
     * @param integer $taxId
     * @return \BillAgain\Taxes
     */
    public function deleteTax($taxId) {
        if (gettype($taxId) == 'integer') {
            $this->taxId = $taxId;
            $this->type = 'DELETE';
            $this->url = '/tax/' . $this->taxId;
            $this->initCurl();
        } else {
            $this->error = 'Tax ID is not an integer value';
        }
        return $this;
    }

}

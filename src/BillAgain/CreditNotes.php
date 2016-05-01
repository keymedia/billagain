<?php

namespace BillAgain;

use BillAgain\Curl;

/**
 * Credit Notes.
 * 
 * Main class for dealing with Credit Notes
 * 
 * @link http://docs.billagain.com/developer/credits
 * @version 1.0.1
 * @license GPL
 * @author Mark Duppa-Whyte <mark@keymedia.co.za>
 * 
 */
class CreditNotes extends Curl {

    /**
     * @var integer $customerId
     */
    protected $customerId;

    /**
     * @var integer $creditNoteId
     */
    protected $creditNoteId;

    /**
     * Get a list of customer's credit notes 
     * 
     * @param integer $customerId
     */
    public function listByCustomer($customerId) {
        if (gettype($customerId) == 'integer') {
            $this->customerId = $customerId;
            $this->type = 'GET';
            $this->url = '/customers/' . $this->customerId . '/credits';
            $this->initCurl();
        } else {
            $this->error = 'Customer ID is not an integer value';
        }
        return $this;
    }

    /**
     * Get a list of credit notes account related
     * 
     */
    public function listCreditNotes() {
        $this->type = 'GET';
        $this->url = '/credits';
        $this->initCurl();
        return $this;
    }

    /**
     * Get specific credit note
     * 
     * @param integer $creditNoteId
     */
    public function getCreditNote($creditNoteId) {
        if (gettype($creditNoteId) == 'integer') {
            $this->creditNoteId = $creditNoteId;
            $this->type = 'GET';
            $this->url = '/credits/' . $this->creditNoteId;
            $this->initCurl();
        } else {
            $this->error = 'Credit Note ID is not an integer value';
        }
        return $this;
    }

    /**
     * Add specific credit note
     * Please check API documentation for required fields
     * 
     * @param array $data
     */
    public function addCreditNote($data = array()) {
        $this->setData($data);
        if ($this->error == '') {
            $this->type = 'POST';
            $this->url = '/credits';
            $this->initCurl();
        }
        return $this;
    }

    /**
     * Edit specific credit note
     * Please check API documentation for required fields
     * 
     * @param integer $creditNoteId
     * @param array $data
     * @return \BillAgain\Credit Notes
     */
    public function editCreditNote($creditNoteId, $data = array()) {
        if (gettype($creditNoteId) == 'integer') {
            $this->creditNoteId = $creditNoteId;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'PUT';
                $this->url = '/credits/' . $this->creditNoteId;
                $this->initCurl();
            }
        } else {
            $this->error = 'Credit Note ID is not an integer value';
        }
        return $this;
    }

    /**
     * Delete specific credit note
     * 
     * @param integer $creditNoteId
     * @return \BillAgain\Credit Notes
     */
    public function deleteCreditNote($creditNoteId) {
        if (gettype($creditNoteId) == 'integer') {
            $this->creditNoteId = $creditNoteId;
            $this->type = 'DELETE';
            $this->url = '/credits/' . $this->creditNoteId;
            $this->initCurl();
        } else {
            $this->error = 'Credit Note ID is not an integer value';
        }
        return $this;
    }

}

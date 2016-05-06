<?php

namespace BillAgain;

use BillAgain\Curl;

/**
 * Subscriptions.
 * 
 * Main class for dealing with Subscriptions
 * 
 * @link http://docs.billagain.com/developer/subscriptions
 * @version 1.0.1
 * @license GPL
 * @author Mark Duppa-Whyte <mark@keymedia.co.za>
 * 
 */
class Subscriptions extends Curl {

    /**
     * @var integer $customerId
     */
    protected $customerId;

    /**
     * @var integer $subscriptionId
     */
    protected $subscriptionId;

    /**
     *
     * @var string $subscriptionType
     */
    protected $subscriptionType;

    /**
     * Get a list of subscriptions customer related
     * 
     * @param integer $customerId
     */
    public function listByCustomer($customerId) {
        if (gettype($customerId) == 'integer') {
            $this->customerId = $customerId;
            $this->type = 'GET';
            $this->url = '/customers/' . $this->customerId . '/subscriptions';
            $this->initCurl();
        } else {
            $this->error = 'Customer ID is not an integer value';
        }
        return $this;
    }

    /**
     * Get a list of subscriptions
     * 
     */
    public function listSubscriptions() {
        $this->type = 'GET';
        $this->url = '/subscriptions';
        $this->initCurl();
        return $this;
    }

    /**
     * Get specific subscriptions
     * 
     * @param integer $subscriptionId
     */
    public function getSubscriptions($subscriptionId) {
        if (gettype($subscriptionId) == 'integer') {
            $this->subscriptionId = $subscriptionId;
            $this->type = 'GET';
            $this->url = '/subscriptions/' . $this->subscriptionId;
            $this->initCurl();
        } else {
            $this->error = 'Subscription ID is not an integer value';
        }
        return $this;
    }

    /**
     * Add subscription
     * Please check API documentation for required fields
     * 
     * @param array $data
     */
    public function addSubscription($data = array()) {
        $this->setData($data);
        if ($this->error == '') {
            $this->type = 'POST';
            $this->url = '/subscriptions';
            $this->initCurl();
        }
        return $this;
    }

    /**
     * Cancel specific subscription 
     * 
     * @param integer $subscriptionId
     * @param string $subscriptionType
     */
    public function cancelSubscription($subscriptionId, $subscriptionType) {
        if (gettype($subscriptionId) == 'integer' && $subscriptionType != '') {
            $this->checkSubscriptionType($subscriptionType);
            if ($this->error == '') {
                $this->type = 'PUT';
                $this->url = '/subscriptions/' . $this->subscriptionId . '/cancel/' . $this->subscriptionType;
                $this->initCurl();
            }
        }

        return $this;
    }

    /**
     * Check to see if the entered value for the subscription types is found in the preset array
     * 
     * @param string $subscriptionType
     */
    private function checkSubscriptionType($subscriptionType) {
        $types = array(
            'renewal',
            'norefund',
            'prorata',
            'fullcredit'
        );

        if (!in_array($subscriptionType, $types)) {
            $this->error = 'Subscription type does not match types in API';
        }
    }

    /**
     * Change specific subscription package
     * Please check API documentation for required fields
     * 
     * @param integer $subscriptionId
     * @param array $data
     * @return \BillAgain\Subscriptions
     */
    public function changePackage($subscriptionId, $data = array()) {
        if (gettype($subscriptionId) == 'integer') {
            $this->subscriptionId = $subscriptionId;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'PUT';
                $this->url = '/subscriptions/' . $this->subscriptionId . '/changePackage';
                $this->initCurl();
            }
        } else {
            $this->error = 'Subscription ID is not an integer value';
        }
        return $this;
    }

    /**
     * Changes specific subscription terms
     * Please check API documentation for required fields
     * 
     * @param integer $subscriptionId
     * @param array $data
     * @return \BillAgain\Subscriptions
     */
    public function changeTerm($subscriptionId, $data = array()) {
        if (gettype($subscriptionId) == 'integer') {
            $this->subscriptionId = $subscriptionId;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'PUT';
                $this->url = '/subscriptions/' . $this->subscriptionId . '/changeterm';
                $this->initCurl();
            }
        } else {
            $this->error = 'Subscription ID is not an integer value';
        }
        return $this;
    }
    
    /**
     * Change subscription start date
     * Please check API documentation for required fields
     * 
     * @param integer $subscriptionId
     * @param array $data
     * @return \BillAgain\Subscriptions
     */
    public function changeStartDate($subscriptionId, $data = array()) {
        if (gettype($subscriptionId) == 'integer') {
            $this->subscriptionId = $subscriptionId;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'PUT';
                $this->url = '/subscriptions/' . $this->subscriptionId . '/changestartdate';
                $this->initCurl();
            }
        } else {
            $this->error = 'Subscription ID is not an integer value';
        }
        return $this;
    }
    
    /**
     * Change subscription end date
     * Please check API documentation for required fields
     * 
     * @param integer $subscriptionId
     * @param array $data
     * @return \BillAgain\Subscriptions
     */
    public function changeEndDate($subscriptionId, $data = array()) {
        if (gettype($subscriptionId) == 'integer') {
            $this->subscriptionId = $subscriptionId;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'PUT';
                $this->url = '/subscriptions/' . $this->subscriptionId . '/changeenddate';
                $this->initCurl();
            }
        } else {
            $this->error = 'Subscription ID is not an integer value';
        }
        return $this;
    }
    
    /**
     * Reactivate specific subscription
     * Please check API documentation for required fields
     * 
     * @param integer $subscriptionId
     * @param array $data
     * @return \BillAgain\Subscriptions
     */
    public function reactivate($subscriptionId, $data = array()) {
        if (gettype($subscriptionId) == 'integer') {
            $this->subscriptionId = $subscriptionId;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'PUT';
                $this->url = '/subscriptions/' . $this->subscriptionId . '/reactivate';
                $this->initCurl();
            }
        } else {
            $this->error = 'Subscription ID is not an integer value';
        }
        return $this;
    }
    
    /**
     * Remove specific subscription future changes
     * Please check API documentation for required fields
     * 
     * @param integer $subscriptionId
     * @return \BillAgain\Subscriptions
     */
    public function removeFutureChanges($subscriptionId) {
        if (gettype($subscriptionId) == 'integer') {
            $this->subscriptionId = $subscriptionId;
            if ($this->error == '') {
                $this->type = 'DELETE';
                $this->url = '/subscriptions/' . $this->subscriptionId . '/futurechanges';
                $this->initCurl();
            }
        } else {
            $this->error = 'Subscription ID is not an integer value';
        }
        return $this;
    }
    
    /**
     * Modify specific subscription components
     * Please check API documentation for required fields
     * 
     * @param integer $subscriptionId
     * @param array $data
     * @return \BillAgain\Subscriptions
     */
    public function modifyComponents($subscriptionId, $data = array()) {
        if (gettype($subscriptionId) == 'integer') {
            $this->subscriptionId = $subscriptionId;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'PUT';
                $this->url = '/subscriptions/' . $this->subscriptionId . '/components/modify';
                $this->initCurl();
            }
        } else {
            $this->error = 'Subscription ID is not an integer value';
        }
        return $this;
    }
    
    /**
     * To increase or decrease component usage, meant for scenarios where usage changes in the period
     * Please check API documentation for required fields
     * 
     * @param integer $subscriptionId
     * @param array $data
     * @return \BillAgain\Subscriptions
     */
    public function recordComponentUsage($subscriptionId, $data = array()) {
        if (gettype($subscriptionId) == 'integer') {
            $this->subscriptionId = $subscriptionId;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'PUT';
                $this->url = '/subscriptions/' . $this->subscriptionId . '/components/recordusage';
                $this->initCurl();
            }
        } else {
            $this->error = 'Subscription ID is not an integer value';
        }
        return $this;
    }

}

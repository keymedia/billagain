<?php

namespace BillAgain\Components;

use BillAgain\Curl;

/**
 * Components.
 * 
 * Main class for dealing with Components
 * 
 * @link http://docs.billagain.com/developer/components
 * @version 1.0.1
 * @license GPL
 * @author Mark Duppa-Whyte <mark@keymedia.co.za>
 * 
 */
class Components extends Curl {

    /**
     * @var integer $componentId
     */
    protected $componentId;

    /**
     * Get a list of components
     * 
     */
    public function listComponents() {
        $this->type = 'GET';
        $this->url = '/components';
        $this->initCurl();
        return $this;
    }

    /**
     * Get specific component
     * 
     * @param integer $componentId
     */
    public function getComponent($componentId) {
        if (gettype($componentId) == 'integer') {
            $this->componentId = $componentId;
            $this->type = 'GET';
            $this->url = '/components/' . $this->componentId;
            $this->initCurl();
        } else {
            $this->error = 'Component ID is not an integer value';
        }
        return $this;
    }

    /**
     * Add specific component
     * Please check API documentation for required fields
     * 
     * @param array $data
     */
    public function addComponent($data = array()) {
        $this->setData($data);
        if ($this->error == '') {
            $this->type = 'POST';
            $this->url = '/components';
            $this->initCurl();
        }
        return $this;
    }

    /**
     * Edit specific component
     * Please check API documentation for required fields
     * 
     * @param integer $componentId
     * @param array $data
     * @return \BillAgain\Components
     */
    public function editComponent($componentId, $data = array()) {
        if (gettype($componentId) == 'integer') {
            $this->componentId = $componentId;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'PUT';
                $this->url = '/components/' . $this->componentId;
                $this->initCurl();
            }
        } else {
            $this->error = 'Component ID is not an integer value';
        }
        return $this;
    }

    /**
     * Delete specific component
     * 
     * @param integer $componentId
     * @return \BillAgain\Components
     */
    public function deleteComponent($componentId) {
        if (gettype($componentId) == 'integer') {
            $this->componentId = $componentId;
            $this->type = 'DELETE';
            $this->url = '/components/' . $this->componentId;
            $this->initCurl();
        } else {
            $this->error = 'Component ID is not an integer value';
        }
        return $this;
    }

}

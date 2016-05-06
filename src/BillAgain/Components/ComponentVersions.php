<?php

namespace BillAgain;

use BillAgain\Curl;

/**
 * ComponentVersions.
 * 
 * Main class for dealing with Component Versions
 * 
 * @link http://docs.billagain.com/developer/component-versions
 * @version 1.0.1
 * @license GPL
 * @author Mark Duppa-Whyte <mark@keymedia.co.za>
 * 
 */
class ComponentVersions extends Curl {

    /**
     * @var integer $componentId
     */
    protected $componentId;

    /**
     * @var integer $versionNumber
     */
    protected $versionNumber;

    /**
     * List component versions
     * 
     * @param integer $componentId 
     */
    public function listComponentVersions($componentId) {
        if (gettype($componentId) == 'integer') {
            $this->componentId = $componentId;
            $this->type = 'GET';
            $this->url = '/components/' . $this->componentId . '/versions';
            $this->initCurl();
        } else {
            $this->error = 'Component ID is not an integer value';
        }
        return $this;
    }

    /**
     * Get specific component version
     * 
     * @param integer $componentId
     * @param integer $versionNumber
     */
    public function getComponentVersion($componentId, $versionNumber) {
        if (gettype($componentId) == 'integer' && gettype($versionNumber) == 'integer') {
            $this->componentId = $componentId;
            $this->versionNumber = $versionNumber;
            $this->type = 'GET';
            $this->url = '/components/' . $this->componentId . '/versions/' . $this->versionNumber;
            $this->initCurl();
        } else {
            $this->error = 'Component ID or Version Number is not an integer value';
        }
        return $this;
    }

    /**
     * Add component version
     * Please check API documentation for required fields
     * 
     * @param integer $componentId
     * @param array $data
     */
    public function addComponentVersion($componentId, $data = array()) {
        if (gettype($componentId) == 'integer') {
            $this->componentId = $componentId;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'POST';
                $this->url = '/components/' . $this->componentId . '/versions/';
                $this->initCurl();
            }
        } else {
            $this->error = 'Component ID is not an integer value';
        }
        return $this;
    }

    /**
     * Edit specific component version
     * Please check API documentation for required fields
     * 
     * @param integer $componentId
     * @param integer $versionNumber
     * @param array $data
     * @return \BillAgain\ComponentVersions
     */
    public function editComponent($componentId, $versionNumber, $data = array()) {
        if (gettype($componentId) == 'integer' && gettype($versionNumber) == 'integer') {
            $this->componentId = $componentId;
            $this->versionNumber = $versionNumber;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'PUT';
                $this->url = '/components/' . $this->componentId . '/versions/' . $this->versionNumber;
                $this->initCurl();
            }
        } else {
            $this->error = 'Component ID or Version Number is not an integer value';
        }
        return $this;
    }

    /**
     * Delete specific version, can not delete last component version
     * 
     * @param integer $componentId
     * @param integer $versionNumber
     * @return \BillAgain\ComponentVersions
     */
    public function deleteComponent($componentId, $versionNumber) {
        if (gettype($componentId) == 'integer' && gettype($versionNumber) == 'integer') {
            $this->componentId = $componentId;
            $this->versionNumber = $versionNumber;
            $this->type = 'DELETE';
            $this->url = '/components/' . $this->componentId . '/versions/' . $this->versionNumber;
            $this->initCurl();
        } else {
            $this->error = 'Component ID or Version Number is not an integer value';
        }
        return $this;
    }

}

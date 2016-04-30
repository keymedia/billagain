<?php

namespace BillAgain;

use BillAgain\Curl;

/**
 * Packages.
 * 
 * Main class for dealing with Packages
 * 
 * @link http://docs.billagain.com/developer/packages
 * @version 1.0.1
 * @license GPL
 * @author Mark Duppa-Whyte <mark@keymedia.co.za>
 * 
 */
class Packages extends Curl {

    /**
     * @var integer $packageId
     */
    protected $packageId;

    /**
     * Get a list of packages
     * 
     */
    public function listPackages() {
        $this->type = 'GET';
        $this->url = '/packages';
        $this->initCurl();
        return $this;
    }

    /**
     * Get specific package
     * 
     * @param integer $packageId
     */
    public function getPackage($packageId) {
        if (gettype($packageId) == 'integer') {
            $this->packageId = $packageId;
            $this->type = 'GET';
            $this->url = '/packages/' . $this->packageId;
            $this->initCurl();
        } else {
            $this->error = 'Package ID is not an integer value';
        }
        return $this;
    }

    /**
     * Add packages
     * Please check API documentation for required fields
     * 
     * @param array $data
     */
    public function addPackage($data = array()) {
        $this->setData($data);
        if ($this->error == '') {
            $this->type = 'POST';
            $this->url = '/packages';
            $this->initCurl();
        }
        return $this;
    }

    /**
     * Edits a package
     * Please check API documentation for required fields
     * 
     * @param integer $packageId
     * @param array $data
     * @return \BillAgain\Packages
     */
    public function editPackage($packageId, $data = array()) {
        if (gettype($packageId) == 'integer') {
            $this->packageId = $packageId;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'PUT';
                $this->url = '/packages/' . $this->packageId;
                $this->initCurl();
            }
        } else {
            $this->error = 'Package ID is not an integer value';
        }
        return $this;
    }

    /**
     * Delete specific package
     * 
     * @param integer $packageId
     * @return \BillAgain\Packages
     */
    public function deletePackage($packageId) {
        if (gettype($packageId) == 'integer') {
            $this->packageId = $packageId;
            $this->type = 'DELETE';
            $this->url = '/packages/' . $this->packageId;
            $this->initCurl();
        } else {
            $this->error = 'Package ID is not an integer value';
        }
        return $this;
    }

}

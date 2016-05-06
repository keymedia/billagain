<?php

namespace BillAgain\Packages;

use BillAgain\Curl;

/**
 * PackageVersions.
 * 
 * Main class for dealing with Package Versions
 * 
 * @link http://docs.billagain.com/developer/package-versions
 * @version 1.0.1
 * @license GPL
 * @author Mark Duppa-Whyte <mark@keymedia.co.za>
 * 
 */
class PackageVersions extends Curl {

    /**
     * @var integer $packageId
     */
    protected $packageId;

    /**
     * @var integer $versionNumber
     */
    protected $versionNumber;

    /**
     * Get a list of package versions
     * 
     * @param integer $packageId 
     */
    public function listPackageVersions($packageId) {
        if (gettype($packageId) == 'integer') {
            $this->packageId = $packageId;
            $this->type = 'GET';
            $this->url = '/packages/' . $this->packageId . '/versions';
            $this->initCurl();
        } else {
            $this->error = 'Package ID is not an integer value';
        }
        return $this;
    }

    /**
     * Get specific package version
     * 
     * @param integer $packageId
     * @param integer $versionNumber
     */
    public function getPackageVersion($packageId, $versionNumber) {
        if (gettype($packageId) == 'integer' && gettype($versionNumber) == 'integer') {
            $this->packageId = $packageId;
            $this->versionNumber = $versionNumber;
            $this->type = 'GET';
            $this->url = '/packages/' . $this->packageId . '/versions/' . $this->versionNumber;
            $this->initCurl();
        } else {
            $this->error = 'Package ID or Version Number is not an integer value';
        }
        return $this;
    }

    /**
     * Add package version
     * Please check API documentation for required fields
     * 
     * @param integer $packageId
     * @param array $data
     */
    public function addPackageVersion($packageId, $data = array()) {
        if (gettype($packageId) == 'integer') {
            $this->packageId = $packageId;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'POST';
                $this->url = '/packages/' . $this->packageId . '/versions/';
                $this->initCurl();
            }
        } else {
            $this->error = 'Package ID is not an integer value';
        }
        return $this;
    }

    /**
     * Edit package version
     * Please check API documentation for required fields
     * 
     * @param integer $packageId
     * @param integer $versionNumber
     * @param array $data
     * @return \BillAgain\PackageVersions
     */
    public function editPackage($packageId, $versionNumber, $data = array()) {
        if (gettype($packageId) == 'integer' && gettype($versionNumber) == 'integer') {
            $this->packageId = $packageId;
            $this->versionNumber = $versionNumber;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'PUT';
                $this->url = '/packages/' . $this->packageId . '/versions/' . $this->versionNumber;
                $this->initCurl();
            }
        } else {
            $this->error = 'Package ID or Version Number is not an integer value';
        }
        return $this;
    }

    /**
     * Delete package version
     * 
     * @param integer $packageId
     * @param integer $versionNumber
     * @return \BillAgain\PackageVersions
     */
    public function deletePackage($packageId, $versionNumber) {
        if (gettype($packageId) == 'integer' && gettype($versionNumber) == 'integer') {
            $this->packageId = $packageId;
            $this->versionNumber = $versionNumber;
                $this->type = 'DELETE';
                $this->url = '/packages/' . $this->packageId . '/versions/' . $this->versionNumber;
                $this->initCurl();
        } else {
            $this->error = 'Package ID or Version Number is not an integer value';
        }
        return $this;
    }

}

<?php

namespace BillAgain;

use BillAgain\Curl;

/**
 * PackageGroups.
 * 
 * Main class for dealing with Package Groups
 * 
 * @link http://docs.billagain.com/developer/package-groups
 * @version 1.0.1
 * @license GPL
 * @author Mark Duppa-Whyte <mark@keymedia.co.za>
 * 
 */
class PackageGroups extends Curl {

    /**
     * @var integer $packageGroupID
     */
    protected $packageGroupID;

    /**
     * Add package group
     * Please check API documentation for required fields
     * 
     * @param array $data
     */
    public function addPackageGroup($data = array()) {
        $this->setData($data);
        if ($this->error == '') {
            $this->type = 'POST';
            $this->url = '/packagegroups';
            $this->initCurl();
        }
        return $this;
    }

    /**
     * Edit package group
     * Please check API documentation for required fields
     * 
     * @param integer $packageGroupID
     * @param array $data
     * @return \BillAgain\Packages
     */
    public function editPackageGroup($packageGroupID, $data = array()) {
        if (gettype($packageGroupID) == 'integer') {
            $this->packageGroupID = $packageGroupID;
            $this->setData($data);
            if ($this->error == '') {
                $this->type = 'PUT';
                $this->url = '/packagegroups/' . $this->packageGroupID;
                $this->initCurl();
            }
        } else {
            $this->error = 'Package Group ID is not an integer value';
        }
        return $this;
    }

    /**
     * Delete package group
     * 
     * @param integer $packageGroupID
     * @return \BillAgain\Packages
     */
    public function deletePackageGroup($packageGroupID) {
        if (gettype($packageGroupID) == 'integer') {
            $this->packageGroupID = $packageGroupID;
            $this->type = 'DELETE';
            $this->url = '/packagegroups/' . $this->packageGroupID;
            $this->initCurl();
        } else {
            $this->error = 'Package Group ID is not an integer value';
        }
        return $this;
    }

}

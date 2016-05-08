<?php

namespace BillAgain;

/**
 * Curl.
 * 
 * Main class for making cURL requests using Basic Auth headers
 * 
 * @version 2.1.0
 * @license GPL
 * @author Mark Duppa-Whyte <mark@keymedia.co.za>
 * 
 */
class Curl {

    /**
     * This value is set in config.ini
     * @var string base_url
     */
    protected $base_url = 'http://api.sandbox.billagain.com/v1';

    /**
     * The cURL connect handle
     * @var resource ch
     */
    protected $ch;

    /**
     * Values in the config file stored in an array format
     * @var array config
     */
    protected $config;

    /**
     * The data (body) to send to server
     * @var array data
     */
    protected $data = array();

    /**
     * The latest error generated
     * @var string error
     */
    protected $error = '';

    /**
     * This value is set in config.ini
     * @var string password
     */
    protected $password;

    /**
     * The body returned from last request
     * @var string response_body
     */
    protected $response_body;

    /**
     * The info returned from last request
     * @var string response_info
     */
    protected $response_info;

    /**
     * The status code returned from last request
     * @var integer response_status
     */
    protected $response_status;

    /**
     * The type of request being sent POST|GET defaults to GET
     * @var string type
     */
    protected $type = 'GET';

    /**
     * The value appended to the $base_url defaults to /customers
     * @var string url
     */
    protected $url = '/customers';

    /**
     * This value set in config.ini
     * @var string username
     */
    protected $username;

    /*     * *********************** Methods ************************ */

    /**
     * Get the current value for variable base_url
     * @return string base_url
     */
    public function getBaseURL() {
        return $this->base_url;
    }
    
    /**
     * Set the value for the base url
     * @param string base_url
     */
    function setBaseURL($base_url = '') {
        $this->base_url = $base_url;
        return $this;
    }

    /**
     * Get the current value for data being sent
     * @return string data
     */
    public function getData() {
        return $this->data;
    }

    /**
     * Set, prep and json encode the data
     * @param array data
     */
    public function setData($data = array()) {
        if (empty($data)) {
            $this->error = 'Empty data array';
        } else {
            foreach ($data as $item) {
                if (!preg_match('/^[\w\@\.]+$/', $item) && $item != NULL) {
                    $this->error = 'Array key has a character violation at: ' . $item . ' Only alphanumeric and selected special characters allowed';
                }
            }
        }
        $this->data = json_encode($data);
        return $this;
    }

    /**
     * Get the current value for variable error
     * @return string error
     */
    function getError() {
        return $this->error;
    }

    /**
     * Get the current value for password
     * @return string password
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set the value for password
     * @param string password
     */
    function setPassword($password = '') {
        $this->password = $password;
        return $this;
    }

    /**
     * Get the current value (body) for response being returned
     * @return string response_body
     */
    public function getResponseBody() {
        return $this->response_body;
    }

    /**
     * Get the current value (info) for response being returned
     * @return string response_info
     */
    public function getResponseInfo() {
        return $this->response_info;
    }

    /**
     * Get the current value for status being returned
     * @return string response_status
     */
    function getResponseStatus() {
        return $this->response_status;
    }

    /**
     * Get the current value for variable type the data is being sent
     * @return string type
     */
    function getType() {
        return $this->type;
    }

    /**
     * Set the value for type POST|GET
     * @param string type
     */
    function setType($type) {
        $this->type = $type;
        return $this;
    }

    /**
     * Get the current value for variable url
     * @return string url
     */
    public function getURL() {
        return $this->url;
    }

    /**
     * Set the value for url
     * @param string url
     */
    function setURL($url = '') {
        $this->url = $url;
        return $this;
    }

    /**
     * Get the current value for username
     * @return string username
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Set the value for username
     * @param string username
     */
    function setUsername($username = '') {
        $this->username = $username;
        return $this;
    }

    /**
     * Makes the cURL request
     * Default url is /customer
     */
    public function initCurl() {

        if ($this->username != '' && $this->password != '') {
            if ($this->error == '') {
                $this->ch = curl_init();
                curl_setopt($this->ch, CURLOPT_URL, $this->base_url . $this->url);
                curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $this->type);
                curl_setopt($this->ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
                curl_setopt($this->ch, CURLOPT_USERPWD, $this->username . ':' . $this->password);
                curl_setopt($this->ch, CURLOPT_POSTFIELDS, $this->data);
                curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($this->ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

                $this->response = curl_exec($this->ch);
                $this->response_info = curl_getinfo($this->ch);
                $this->response_status = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);

                curl_close($this->ch);
            }
        } else {
            $this->error = 'Username|Password blank fields';
        }
        return $this;
    }

}

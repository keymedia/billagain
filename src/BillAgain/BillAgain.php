<?php

namespace src\BillAgain;

class BillAgain {

    /**
     * The full API URL
     * @var string $api
     */
    private $api;

    /**
     * The module being requested
     * @var string $module
     */
    private $module;

    /**
     * The query type GET|POST|PUT|DELETE etc
     * @var string $type
     */
    private $type;

    /**
     * The query action - where required
     * @var string $action
     */
    private $action;

    /**
     * The username required for authentication
     * @var string $username
     */
    private $username;

    /**
     * The API key required for authentication
     * @var string $key
     */
    private $key;

    /**
     * The data to send to server
     * @var array $data
     */
    private $data = array();

    /**
     * The unique ID for singular queries
     * @var string $id
     */
    private $id;

    /**
     * The URL created directly or with the buildURL method
     * @var string $url
     */
    public $url;

    /**
     * The page number of the request for pagination - where necessary
     * @var string $page
     */
    public $page;

    /**
     * The limit or number of items returned (max 200) - where necessary
     * @var string $limit
     */
    public $limit;

    /**
     * This is set when a violation occurs
     * @var string $error
     */
    private $error = '';

    /**
     * The data returned from last request
     * @var string response_body
     */
    private $response;

    /**
     * The info returned from last request
     * @var string response_info
     */
    private $responseInfo;

    /**
     * The status code returned from last request
     * @var integer response_status
     */
    private $responseStatus;
    
    /* ****************** Methods ****************** */

    public function __construct($api, $username, $key) {
        $this->api = rtrim($api, '/\\');
        $this->username = $username;
        $this->key = $key;
    }

    public function initRequest($type, $data, $url = '') {
        if ($url != '') {
            $this->url = $url;
        }
        $this->type = strtoupper($type);
        $this->data = $data;

        if ($this->username == '' || $this->key == '') {
            $this->error = 'Username|Key has not been set';
        }

        if ($this->type == 'PUT' || $this->type == 'POST') {
            $this->encodeData();
        }

        if ($this->error == '') {
            $this->initCurl();
        }
    }

    public function initRequestBuilder($module, $type, $data, $page = '', $limit = '', $id = '', $action = '') {
        $this->module = rtrim($module, '/\\');
        $this->page = (int) $page;
        $this->limit = (int) $limit;
        $this->type = strtoupper($type);
        $this->action = rtrim($action, '/\\');

        if ((int) $id != 0) {
            $this->id = (int) $id;
        }

        if ($this->username == '' || $this->key == '') {
            $this->error = 'Username|Key has not been set';
        }

        if ($this->id == '' && $this->action != '') {
            $this->error = 'Cannot have an action without an ID';
        }

        if ($this->type == 'PUT' || $this->type == 'POST') {
            $this->encodeData($data);
        }

        if ($this->error == '') {
            $this->buildURL();
            $this->initCurl();
        }
    }

    private function buildURL() {
        $url = [
            $this->api,
            $this->module,
            $this->id,
            $this->action
        ];
        $this->url = rtrim(implode('/', $url), '/\\');
    }

    /**
     * Set, prep and json encode the data
     * @param array data
     */
    public function encodeData($data) {
        if (empty($data)) {
            $this->error = 'Empty data array';
        }
        $this->data = json_encode($data);
    }

    /**
     * Makes the cURL request
     */
    private function initCurl() {

        if ($this->error == '') {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->type);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->key);

            if ($this->type == 'PUT' || $this->type == 'POST') {
                curl_setopt($ch, CURLOPT_POSTFIELDS, $this->data);
            }

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

            $this->response = curl_exec($ch);
            $this->responseInfo = curl_getinfo($ch);
            $this->responseStatus = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);
        }
    }

    public function getError() {
        return $this->error;
    }

    public function getResponse() {
        return $this->response;
    }

    public function getResponseInfo() {
        return $this->responseInfo;
    }

    public function getResponseStatus() {
        return $this->responseStatus;
    }

}

<?php

namespace src\BillAgain;

class BillAgain {

    /**
     * The API URL
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
     * The query action
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
     * The URL string
     * @var string $url
     */
    private $url;

    /**
     * The page number of the request for pagination
     * @var string $page
     */
    private $page;

    /**
     * The limit or number of items returned (max 200)
     * @var string $page_size
     */
    private $page_size;

    /**
     * This is set when a violation occurs
     * @var string $error
     */
    private $error = '';

    /**
     * The data returned from last request
     * @var array $response
     */
    private $response;

    /**
     * The info returned from last request
     * @var array $response_info
     */
    private $response_info;

    /**
     * The status code returned from last request
     * @var integer $response_status
     */
    private $response_status;

    /*     * ***************** Methods ****************** */

    public function __construct($api, $username, $key) {
        $this->api = rtrim($api, '/\\');
        $this->username = $username;
        $this->key = $key;
    }

    public function initRequest($url, $type, $data) {
        $this->url = $url;
        $this->type = strtoupper($type);
        $this->data = $data;
        if ($this->error == '') {
            $this->initCurl();
        }
    }

    public function initRequestBuilder($module, $type, $data, $id = '', $action = '', $page = 1, $page_size = 100) {
        $this->module = rtrim($module, '/\\');
        $this->id = $id;
        $this->action = rtrim($action, '/\\');
        $this->page = $page;
        $this->page_size = $page_size;
        $this->type = strtoupper($type);

        if ($this->id == '' && $this->action != '') {
            $this->error = 'Cannot have an action without an ID';
        }
        $this->encodeData($data);

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

        $this->url = rtrim(implode('/', $url), '/\\') . '?page=' . $this->page . '&page_size=' . $this->page_size;
    }

    private function encodeData($data) {
        if ($this->type == 'PUT' || $this->type == 'POST') {
            if (empty($data) || $data == '') {
                $this->error = 'Empty data array';
            }
            $this->data = json_encode($data);
        }
    }

    private function initCurl() {

        if ($this->username == '' || $this->key == '') {
            $this->error = 'Username|Key has not been set';
        }

        if ($this->error == '') {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $this->url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $this->type);
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_USERPWD, $this->username . ':' . $this->key);

            if ($this->type == 'PUT' || $this->type == 'POST') {
                curl_setopt($ch, CURLOPT_POSTFIELDS, encodeData($this->data));
            }

            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));

            $this->response = curl_exec($ch);
            $this->response_info = curl_getinfo($ch);
            $this->response_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

            curl_close($ch);
        }
    }

    /* ****************** Getters ****************** */
    
    public function getUrl() {
        return $this->url;
    }

    public function getError() {
        return $this->error;
    }

    public function getResponse() {
        return $this->response;
    }

    public function getResponseInfo() {
        return $this->response_info;
    }

    public function getResponseStatus() {
        return $this->response_status;
    }

}

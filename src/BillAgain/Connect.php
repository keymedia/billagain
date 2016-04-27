<?php

namespace BillAgain;

class Connect {

    public $username;
    public $password;
    public $url;
    public $curl_header_code;
    public $curl_returned_data;

    public function __construct() {
        $cfg = $this->getConfig();
        if (is_array($cfg)) {
            $this->username = $cfg['username'];
            $this->password = $cfg['password'];
            $this->url = $cfg['url'];
        }
    }

    private function getConfig() {
        if (file_exists(dirname(__FILE__) . '/config/config.ini')) {
            $config = parse_ini_file(dirname(__FILE__) . '/config/config.ini');
            return $config;
        }
    }

    public function curlRequest($url, $method = 'GET', $data = array()) {

        $complete_url = $this->url . $url;
        $auth = $this->username . ':' . $this->password;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $complete_url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
        curl_setopt($ch, CURLOPT_USERPWD, $auth);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, true);

        $this->curl_returned_data = curl_exec($ch);
        $this->curl_header_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return true;
    }

}

<?php

namespace BambooHR;

use GuzzleHttp\Client;

class BambooHR
{
    /**
     * The Guzzle instance used for all requests to the BambooHR API
     *
     * @var \GuzzleHttp\Client
     */
    public $client;

    /**
     * BambooHR Company Name
     *
     * @var string
     */
    public $company;

    /**
     * API token for authenticated requests
     *
     * @var string
     */
    public $token;

    /**
     * The default configuration options
     *
     * @var array
     */
    public $options = [
        'base_uri' => 'https://api.bamboohr.com/api/gateway.php/',
        'version' => 'v1',
    ];

    /**
     * BambooHR API constructor
     *
     * @param string $company
     * @param string $token
     * @param array  $options
     */
    public function __construct($company = "", $token = "", $options = [])
    {
        $this->company = $company;
        $this->token = $token;

        $this->options = array_merge($options, $this->options);

        $this->client = new Client();
    }

    /**
     * [_buildUrl description]
     *
     * @param  string $path         [description]
     * @param  array  $queryStrings [description]
     * @param  string $domain       [description]
     *
     * @return string               [description]
     */
    public function _buildUrl($path = "", $queryStrings = [], $domain = "")
    {
        $queryString = "";
        foreach ($queryStrings as $key => $value) {
            if (is_array($value)) {
                continue;
            }

            $queryString .= "&{$key}={$value}";
        }
        if (strlen($queryString) > 0) {
            $queryString = "?" . substr($queryString, 1);
        }

        if ($domain == "") {
            $domain = $this->options['base_uri'];
        }

        $path = "/" . trim($path, "/") . "/";

        return "{$domain}{$this->company}/{$this->options['version']}{$path}{$queryString}";
    }

    /**
     * [_getHeaders description]
     *
     * @param boolean $auth
     * 
     * @return array
     */
    public function _getHeaders($auth = true)
    {
        $headers = [
            'Content-Type'  => 'application/x-www-form-urlencoded',
            'Accept'        => 'application/json',
        ];

        // HTTP Basic Auth
        if ($auth) {
            $headers['Authorization'] = 'Basic ' . base64_encode("{$this->token}:x");
        }

        return $headers;
    }

    /**
     * Undocumented function
     *
     * @param string $name
     * 
     * @return
     */
    protected function api($name)
    {
        switch ($name) {
            case 'employee':
            case 'employees':
                return new Api\Employees($this);
            
            case 'company':
                return new Api\Company($this);

            case 'report':
            case 'reports':
                return new Api\Reports($this);

            case 'table':
            case 'tables':
                return new Api\Tables($this);

            case 'timeoff':
            case 'timeOff':
            case 'time_off':
            case 'pto':
                return new Api\TimeOff($this);

            case 'time':
            case 'timetracking':
            case 'time_tracking':
            case 'timeTracking':
                return new Api\TimeTracking($this);

            default:
                throw new \Exception("Invalid API ($name)");
        }
    }

    /**
     * [__call description]
     *
     * @param  [type] $method [description]
     * @param  [type] $args   [description]
     *
     * @return [type]         [description]
     */
    public function __call($method, $args)
    {
        return $this->api($method);
    }

    /**
     * [__get description]
     *
     * @param  [type] $property [description]
     *
     * @return [type]           [description]
     */
    public function __get($property)
    {
        return $this->api($property);
    }
}

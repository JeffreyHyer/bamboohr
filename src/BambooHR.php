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
    public $domain;

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
     * @param string $domain    The company name/subdomain in BambooHR
     * @param string $token     The API Token to use when sending requests
     * @param array  $options   An array of options ['base_uri', 'version'] to override the defaults
     */
    public function __construct($domain = "", $token = "", $options = [])
    {
        $this->domain = $domain;
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

        return "{$domain}{$this->domain}/{$this->options['version']}{$path}{$queryString}";
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
        $headers = ['Accept' => 'application/json'];

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
            case 'benefit':
            case 'benefits':
                return new Api\Benefits($this);

            case 'company':
            return new Api\Company($this);

            case 'employee':
            case 'employees':
                return new Api\Employees($this);

            case 'image':
            case 'images':
            case 'photo':
            case 'photos':
                return new Api\Photos($this);

            case 'lastChanged':
            case 'lastChange':
            case 'changed':
            case 'changes':
                return new Api\LastChanged($this);

            case 'login':
            case 'auth':
                return new Api\Login($this);

            case 'meta':
            case 'metadata':
            case 'metaData':
                return new Api\Metadata($this);

            case 'payroll':
                return new Api\Payroll($this);

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

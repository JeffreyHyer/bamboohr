<?php

namespace BambooHR\Api;

use Psr\Http\Message\ResponseInterface;

class Response {

    protected $code = 0;

    protected $reason = "";

    protected $errors = [];

    protected $response = [];

    public function __construct(ResponseInterface $response)
    {
        $this->code = $response->getStatusCode();
        $this->reason = $response->getReasonPhrase();
        $this->response = json_decode($response->getBody()->getContents());
        
        $this->errors = $this->_getErrors($response);
    }

    public function hasErrors()
    {
        return !empty($this->errors);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getReason()
    {
        return $this->reason;
    }

    public function getResponse()
    {
        return $this->response;
    }

    private function _getErrors(ResponseInterface $response)
    {
        foreach ($response->getHeaders() as $header => $value) {
            if ($header == "X-BambooHR-Error-Message") {
                return [$value];
            } else if ($header == "X-BambooHR-Error-Messsage") {
                return [$value];
            }
        }

        return [];
    }

    /*
        public function __get($property)
        {
            // TODO:
            // - Implement access to values via dot notation (e.g. laravel helper methods, array_get/array_has)
            return $this->response[$property];
        }
    */

}
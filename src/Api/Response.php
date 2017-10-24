<?php

namespace BambooHR\Api;

use GuzzleHttp\Psr7\Response as ResponseInterface;

class Response {

    protected $code = 0;

    protected $reason = "";

    protected $errors = [];

    protected $response = [];

    public function __construct(ResponseInterface $response)
    {
        $this->code = $response->getStatusCode();
        $this->reason = $response->getReasonPhrase();
        $this->response = $this->_parseResponse($response);
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

    private function _parseResponse(ResponseInterface $response)
    {
        if ($response->hasHeader('Content-Type')) {
            $contentType = $response->getHeader('Content-Type');
            
            if (is_array($contentType)) {
                $contentType = $contentType[0];
            }

            // JSON
            if (strpos($contentType, "application/json") !== false) {
                return json_decode($response->getBody()->getContents());
            }

            // ----------
            // TODO: This method *may* present an issue if the XML has both an attribute AND
            //       a value (e.g. <node id="1">value</node>) (see https://stackoverflow.com/a/20506281/2116923)
            //       but this is untested in PHP 7.x (issue may have been resolved) and with
            //       the BambooHR XML responses (may not contain XML with both attributes and values)
            // ----------
            // XML
            if (strpos($contentType, "text/xml") !== false) {
                $xml = simplexml_load_string($response->getBody()->getContents());
                return json_decode(stripslashes(json_encode($xml)));
            }
        }

        return $response->getBody()->getContents();
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
<?php

namespace BambooHR\Api;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use BambooHR\BambooHR;

abstract class AbstractApi
{
    protected $bamboo;

    /**
     * [__construct description]
     *
     * @param \BambooHR\BambooHR $bamboo [description]
     */
    public function __construct(BambooHR $bamboo)
    {
        $this->bamboo = $bamboo;
    }

    /**
     * [get description]
     *
     * @param  [type] $path     [description]
     * @param  [type] $queryStr [description]
     *
     * @return [type]           [description]
     */
    public function get($path, $queryStr = [], $auth = true)
    {
        try {
            $response = $this->bamboo->client->request(
                'GET',
                $this->bamboo->_buildUrl($path, $queryStr),
                [
                    'headers' => $this->bamboo->_getHeaders($auth)
                ]
            );

            return $this->_respond($response);
        } catch (\GuzzleHttp\Exception\TransferException $e) {
            if ($e->hasResponse()) {
                return $this->_respond($e->getResponse());
            } else {
                throw $e;
            }
        }
    }

    /**
     * [post description]
     *
     * @param  string  $path     [description]
     * @param  array   $body     [description]
     * @param  array   $queryStr [description]
     * @param  boolean $auth     [description]
     *
     * @return object            [description]
     */
    public function post($path, $body, $queryStr = [], $auth = true)
    {
        $request = ['headers' => $this->bamboo->_getHeaders($auth)];

        if (is_array($body)) {
            $request['form_params'] = $body;
        } else {
            $request['body'] = $body;
        }

        try {
            $response = $this->bamboo->client->request(
                'POST',
                $this->bamboo->_buildUrl($path, $queryStr),
                $request
            );

            return $this->_respond($response);
        } catch (\GuzzleHttp\Exception\TransferException $e) {
            if ($e->hasResponse()) {
                return $this->_respond($e->getResponse());
            } else {
                throw $e;
            }
        }
    }

    /**
     * Undocumented function
     *
     * @param string  $path
     * @param array   $body
     * @param array   $queryStr
     * @param boolean $auth
     * 
     * @return void
     */
    public function put($path, $body, $queryStr = [], $auth = true)
    {
        $request = ['headers' => $this->bamboo->_getHeaders($auth)];

        if (is_array($body)) {
            $request['form_params'] = $body;
        } else {
            $request['body'] = $body;
        }

        try {
            $response = $this->bamboo->client->request(
                'PUT',
                $this->bamboo->_buildUrl($path, $queryStr),
                $request
            );

            return $this->_respond($response);
        } catch (\GuzzleHttp\Exception\TransferException $e) {
            if ($e->hasResponse()) {
                return $this->_respond($e->getResponse());
            } else {
                throw $e;
            }
        }
    }

    /**
     * Undocumented function
     *
     * @param string  $path
     * @param array   $queryStr
     * @param boolean $auth
     * 
     * @return void
     */
    public function delete($path, $queryStr = [], $auth = true)
    {
        try {
            $response = $this->bamboo->client->request(
                'DELETE',
                $this->bamboo->_buildUrl($path, $queryStr),
                [
                    'headers' => $this->bamboo->_getHeaders($auth)
                ]
            );

            return $this->_respond($response);
        } catch (\GuzzleHttp\Exception\TransferException $e) {
            if ($e->hasResponse()) {
                return $this->_respond($e->getResponse());
            } else {
                throw $e;
            }
        }
    }

    /**
     * Undocumented function
     *
     * @param string $path
     * @param array $body   ['NAME' => 'VALUE', ..., 'file' => ['name' => string, 'filename' => string, 'mimeType' => string, 'contents' => string]]
     * @param array $queryStr
     * @param boolean $auth
     * @return void
     */
    public function postFile($path, array $body, $queryStr = [], $auth = true)
    {
        $multipart = [];

        foreach ($body as $key => $value) {
            if ($key == "file") {
                $multipart[] = [
                    'name' => $value['name'],
                    'contents' => $value['contents'],
                    'headers' => (isset($value['mimeType']) ? ['Content-Type' => $value['mimeType']] : []),
                    'filename' => $value['filename'],
                ];
            } else {
                $multipart[] = [
                    'name' => $key,
                    'contents' => $value,
                ];
            }
        }

        try {
            $response = $this->bamboo->client->request(
                'POST',
                $this->bamboo->_buildUrl($path, $queryStr),
                [
                    'headers' => $this->bamboo->_getHeaders($auth),
                    'multipart' => $multipart
                ]
            );

            return $this->_respond($response);
        } catch (\GuzzleHttp\Exception\TransferException $e) {
            if ($e->hasResponse()) {
                return $this->_respond($e->getResponse());
            } else {
                throw $e;
            }
        }
    }

    /**
     * [_respond description]
     *
     * @param  Psr\Http\Message\ResponseInterface $response [description]
     *
     * @return [type]                                       [description]
     */
    protected function _respond(ResponseInterface $response)
    {
        return new Response($response);
    }
}

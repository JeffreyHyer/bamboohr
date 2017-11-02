<?php

namespace BambooHR\Api;

/**
 * Login API
 * 
 * @link https://www.bamboohr.com/api/documentation/login.php
 */
class Login extends AbstractApi
{

    /**
     * Login as a given user, identified by the provided username and password.
     *
     * @param string $username Username
     * @param string $password Password
     * @param string $appKey   Application Key
     * @param string $deviceId [Optional] A unique ID specific to a users device
     * 
     * @return \BambooHR\Api\Response
     */
    public function login($username, $password, $appKey, $deviceId = "")
    {
        return $this->post("login", ['username' => $username, 'password' => $password, 'applicationKey' => $appKey, 'deviceId' => $deviceId]);
    }

}
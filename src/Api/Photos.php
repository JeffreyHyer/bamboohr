<?php

namespace BambooHR\Api;

/**
 * Photos API
 * 
 * @link https://www.bamboohr.com/api/documentation/photos.php
 */
class Photos extends AbstractApi
{

    /**
     * Get the current photo for a given employee.
     * Returns the binary data of the image, the image
     * is in JPEG format (image/jpeg) and is 150px square.
     *
     * @param string $id The employee ID
     * 
     * @return BambooHR\Api\Response
     */
    public function getEmployeePhoto($id)
    {
        return $this->get("employees/{$id}/photo/small");
    }

    /**
     * Upload a new photo for a given employee.
     * 
     * NOTES:
     *  - The width and height must be equal (image must be square)
     *  - Image must be in jpg, gif, or png format
     *  - Max file size is 20MB
     *
     * @param string $id
     * @param array $data
     * 
     * @return BambooHR\Api\Response
     */
    public function uploadEmployeePhoto($id, array $data)
    {
        return $this->postFile("employees/{$id}/photo", $data);
    }

    /**
     * Get the URL of an employee's photo
     * 
     * This works similar to Gravatar where the URL scheme is known
     * so no API call is made to the BambooHR service when using this
     * method.
     * 
     * NOTES:
     *  - Returns the URL to a JPEG image that is 150px square
     *  - If an image does not exist for the given employee it
     *    will return customized placeholder image (e.g. employees
     *    initials on a solid background)
     *
     * @param string $email The email address of the employee
     * @param bool $secure Return a secure URL (HTTPS)
     * 
     * @return string
     */
    public function getPhotoUrl(string $email, bool $secure = true)
    {
        $hash = md5(strtolower(trim($email)));

        $url = ($secure ? "https://" : "http://");
        $url .= "{$this->bamboo->domain}.bamboohr.com/employees/photos/?h={$hash}";

        return $url;
    }

}
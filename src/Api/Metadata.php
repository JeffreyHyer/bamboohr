<?php

namespace BambooHR\Api;

/**
 * Metadata API
 * 
 * @link https://www.bamboohr.com/api/documentation/metadata.php
 */
class Metadata extends AbstractApi
{

    /**
     * Get a list of fields
     *
     * @return \BambooHR\Api\Response
     */
    public function fields()
    {
        return $this->get("meta/fields");
    }

    /**
     * Get a list of tabular fields
     *
     * @return \BambooHR\Api\Response
     */
    public function tables()
    {
        return $this->get("meta/tables");
    }

    /**
     * Get the details for "list" fields
     *
     * @return \BambooHR\Api\Response
     */
    public function lists()
    {
        return $this->get("meta/lists");
    }

    /**
     * Add or update values for "list" fields
     *
     * @param string $listId
     * @param array $options [['id' => string (optional), 'archived' => 'yes|no' (optional), 'value' => string (required)], ...]
     * 
     * @return \BambooHR\Api\Response
     */
    public function addEditList($listId, array $options)
    {
        $xml = "<options>";

        foreach ($options as $option) {
            $xml .= "<option";

            if (isset($option['id'])) {
                $xml .= " id=\"{$option['id']}\"";
            }

            if (isset($option['archived'])) {
                $xml .= " archived=\"{$option['archived']}\"";
            }

            $xml .= ">{$option['value']}</option>";
        }

        $xml .= "</options>";

        return $this->put("meta/lists/{$listId}", $xml);
    }

    /**
     * Get a list of time off types
     *
     * @return \BambooHR\Api\Response
     */
    public function timeOffTypes()
    {
        return $this->get("meta/time_off/types");
    }

    /**
     * Get a list of time off policies
     *
     * @return \BambooHR\Api\Response
     */
    public function timeOffPolicies()
    {
        return $this->get("meta/time_off/policies");
    }

    /**
     * Get a list of users
     *
     * @return \BambooHR\Api\Response
     */
    public function users()
    {
        return $this->get("meta/users");
    }

}

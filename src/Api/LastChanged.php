<?php

namespace BambooHR\Api;

/**
 * Last Changed API
 * 
 * @link https://www.bamboohr.com/api/documentation/changes.php
 */
class LastChanged extends AbstractApi
{

    /**
     * Retrieve a list of employees that have changed sinced
     * a given date, optionally filtered by the change type.
     *
     * @param string $since ISO 8601 date (see link for acceptable formats)
     * @param string $type  [Optional] One of "inserted", "updated", or "deleted".
     * @return void
     */
    public function changed($since, $type = "")
    {
        return $this->get("employees/changed", ['since' => $since, 'type' => $type]);
    }

}
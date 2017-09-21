<?php

namespace BambooHR\Api;

/**
 * Time Tracking
 * 
 * @link https://www.bamboohr.com/api/documentation/time_tracking.php
 */
class TimeTracking extends AbstractApi
{

    public function getRecord($timeTrackingId)
    {
        return $this->get("timetracking/record/{$timeTrackingId}/");
    }

    public function addRecord(array $data = [])
    {
        return $this->post("timetracking/add", $data);
    }

}

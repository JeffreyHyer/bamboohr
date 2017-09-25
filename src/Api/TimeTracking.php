<?php

namespace BambooHR\Api;

/**
 * Time Tracking
 * 
 * @link https://www.bamboohr.com/api/documentation/time_tracking.php
 */
class TimeTracking extends AbstractApi
{

    /**
     * Get the details of an individual time tracking record
     * identified by it's $timeTrackingId.
     *
     * @param string $timeTrackingId
     * 
     * @return \BambooHR\Api\Response
     */
    public function getRecord($timeTrackingId)
    {
        return $this->get("timetracking/record/{$timeTrackingId}/");
    }

    /**
     * Add a new time tracking record
     *
     * @param array $data
     * 
     * @return \BambooHR\Api\Response
     */
    public function addRecord(array $data = [])
    {
        return $this->post("timetracking/add", $data);
    }

    /**
     * Edit an existing time tracking record identified
     * by it's $timeTrackingid
     *
     * @param string    $timeTrackingId
     * @param array     $data
     * 
     * @return \BambooHR\Api\Response
     */
    public function editRecord($timeTrackingId, array $data = [])
    {
        $data = array_merge($data, ['timeTrackingId' => $timeTrackingId]);

        return $this->put("timetracking/adjust", $data);
    }

    /**
     * Delete an existing time tracking record identified
     * by it's $timeTrackingId
     *
     * @param string $timeTrackingId
     * 
     * @return \BambooHR\Api\Response
     */
    public function deleteRecord($timeTrackingId)
    {
        return $this->delete("timetracking/delete/{$timeTrackingId}");
    }

    /**
     * Bulk add and/or edit time tracking records
     *
     * @param array $records An array of time tracking objects to be added or edited
     * 
     * @return \BambooHR\Api\Response
     */
    public function bulkAddEditRecords(array $records = [])
    {
        return $this->post("timetracking/record", $records);
    }

}

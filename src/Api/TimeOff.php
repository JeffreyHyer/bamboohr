<?php

namespace BambooHR\Api;

/**
 * Time Off
 * 
 * @link https://www.bamboohr.com/api/documentation/time_off.php
 */
class TimeOff extends AbstractApi
{

    /**
     * Returns all time off requests that are visible to the authenticated user.
     *
     * @param array $filters Various fields that can be used to filter the results
     *                       returned. See https://www.bamboohr.com/api/documentation/time_off.php
     *                       for details.
     * 
     * @return BambooHR\Api\Response
     */
    public function requests(array $filters = [])
    {
        return $this->get("time_off/requests/", $filters);
    }

    /**
     * Submit a new time off request for a given employeeId
     * 
     * @param string $employeeId
     * @param array  $data  An array of data describing the time off request
     *                      [
     *                          'start' => [ISO-8601 Date],
     *                          'end' => [ISO-8601 Date],
     *                          'timeOffTypeId' => [integer],   // Comes from the Metadata API...
     *                          'amount' => [integer],  // Ignored if 'dates' is provided below
     *                          'notes' => [string],
     *                          'dates' => [
     *                              'YYYY-MM-DD' => [integer] // Number of hours to request for the given date
     *                          ],
     *                          'previousRequest' => [integer]
     *                      ]
     * 
     * @return void
     */
    public function submitRequest($employeeId, array $data = [])
    {
        // TODO: Cleanup...
        $xml = "
            <request>
                <status>requested</status>
                <start>{$data['start']}</start>
                <end>{$data['end']}</end>
                <timeOffTypeId>{$data['timeOffTypeId']}</timeOffTypeId>
                <amount>{$data['amount']}</amount>
                <notes>
                    <note from=\"employee\">{$data['notes']}</note>
                </notes>
                <dates>";

        foreach ($data['dates'] as $date => $hours) {
            $xml .= "<date ymd=\"{$date}\" amount=\"{$hours}\" />";
        }

        $xml .= "
                </dates>
                <previousRequest>{$data['previousRequest']}</previousRequest>
            </request>";

        return $this->put("employees/{$employeeId}/time_off/request", $xml);
    }

    public function changeRequestStatus($requestId, $status, string $note = "")
    {
        $xml = "
            <request>
                <status>{$status}</status>
                <note>{$note}</note>
            </request>
        ";

        return $this->put("time_off/requests/{$requestId}/status", $xml);
    }

    public function addHistoryEntry($employeeId, $requestId, string $date, string $note)
    {
        $xml = "
            <history>
                <date>{$date}</date>
                <eventType>used</eventType>
                <timeOffRequestId>{$requestId}</timeOffRequestId>
                <note>{$note}</note>
            </history>
        ";

        $this->put("employees/{$employeeId}/time_off/history", $xml);
    }

    // v1
    // public function assignedPolicies($employeeId)
    // {
    //     return $this->get("employees/{$employeeId}/time_off/policies");
    // }

    public function assignedPolicies($employeeId)
    {
        $this->bamboo->options['version'] = 'v1_1';

        $response = $this->get("employees/{$employeeId}/time_off/policies");

        $this->bamboo->options['version'] = 'v1';

        return $response;
    }

    public function whosOut(string $start = "", string $end = "")
    {
        return $this->get("time_off/whos_out/", ['start' => $start, 'end' => $end]);
    }

    public function whoIsOut(string $start = "", string $end = "")
    {
        return $this->whosOut($start, $end);
    }

}

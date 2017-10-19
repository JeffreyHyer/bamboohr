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
     * @return BambooHR\Api\Response
     */
    public function submitRequest($employeeId, array $data = [])
    {
        $xml = "<request>
                <status>requested</status>
                <start>{$data['start']}</start>
                <end>{$data['end']}</end>
                <timeOffTypeId>{$data['timeOffTypeId']}</timeOffTypeId>
                <amount>{$data['amount']}</amount>";
        
        if (isset($data['notes'])) {
            $xml .= "<notes><note from=\"employee\">{$data['notes']}</note></notes>";
        }

        $xml .= "<dates>";

        foreach ($data['dates'] as $date => $hours) {
            $xml .= "<date ymd=\"{$date}\" amount=\"{$hours}\" />";
        }

        $xml .= "</dates>";

        if (isset($data['previousRequest'])) {
            $xml .="<previousRequest>{$data['previousRequest']}</previousRequest>";
        }

        $xml .= "</request>";

        return $this->put("employees/{$employeeId}/time_off/request", $xml);
    }

    /**
     * Change the status of a time off request
     *
     * @param string $requestId
     * @param string $status
     * @param string $note
     * 
     * @return BambooHR\Api\Response
     */
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

    /**
     * Add a time off history entry
     *
     * @param string $employeeId
     * @param string $requestId
     * @param string $date
     * @param string $note
     * 
     * @return \BambooHR\Api\Response
     */
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

    /**
     * List assigned time off policies for a given employee
     *
     * @param string $employeeId
     * 
     * @return \BambooHR\Api\Response
     */
    public function assignedPolicies($employeeId)
    {
        $this->bamboo->options['version'] = 'v1_1';

        $response = $this->get("employees/{$employeeId}/time_off/policies");

        $this->bamboo->options['version'] = 'v1';

        return $response;
    }

    /**
     * Assign one or more time off policies to a given employee
     * 
     * @link https://www.bamboohr.com/api/documentation/time_off.php#assignTimeOffPolicies1.1
     *
     * @param string $employeeId
     * @param array $policies
     * 
     * @return \BambooHR\Api\Response
     */
    public function assignPolicy($employeeId, array $policies)
    {
        $this->bamboo->options['version'] = 'v1_1';
        
        $response = $this->put("employees/{$employeeId}/time_off/policies", json_encode($policies));

        $this->bamboo->options['version'] = 'v1';

        return $response;
    }

    public function addHistoryOverride($employeeId, array $data)
    {
        $xml = "<history>";

        if (isset($data['date'])) {
            $xml .= "<date>{$data['date']}</date>";
        }

        if (isset($data['timeOffTypeId'])) {
            $xml .= "<timeOffTypeId>{$data['timeOffTypeId']}</timeOffTypeId>";
        }

        if (isset($data['amount'])) {
            $xml .= "<amount>{$data['amount']}</amount>";
        }

        if (isset($data['note'])) {
            $xml .= "<note>{$data['note']}</note>";
        }

        $xml .= "<eventType>override</eventType>";
        $xml .= "</history>";

        return $this->put("employees/{$employeeId}/time_off/history", $xml);
    }

    public function whosOut(string $start = "", string $end = "")
    {
        return $this->get("time_off/whos_out/", ['start' => $start, 'end' => $end]);
    }

    public function whoIsOut(string $start = "", string $end = "")
    {
        return $this->whosOut($start, $end);
    }

    public function calculate($employeeId, $date = null)
    {
        if (is_null($date)) {
            $date = date('Y-m-d');
        } else {
            $date = date('Y-m-d', strtotime($date));
        }

        return $this->get("employees/{$employeeId}/time_off/calculator", ['end' => $date]);
    }

}

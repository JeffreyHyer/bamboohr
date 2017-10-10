<?php

namespace BambooHR\Api;

class Employees extends AbstractApi
{

    private static $defaultFields = [
        'address1',
        'address2',
        'age',
        'bestEmail',
        'birthday',
        'city',
        'country',
        'dateOfBirth',
        'department',
        'division',
        'eeo',
        'employeeNumber',
        'employmentHistoryStatus',
        'ethnicity',
        'exempt',
        'firstName',
        'flsaCode',
        'fullName1',
        'fullName2',
        'fullName3',
        'fullName4',
        'fullName5',
        'displayName',
        'gender',
        'hireDate',
        'originalHireDate',
        'homeEmail',
        'homePhone',
        'id',
        'jobTitle',
        'lastChanged',
        'lastName',
        'location',
        'maritalStatus',
        'middleName',
        'mobilePhone',
        'payChangeReason',
        'payGroup',
        'payGroupId',
        'payRate',
        'payRateEffectiveDate',
        'payType',
        'payPer',
        'payPeriod',
        'includeInPayroll',
        'preferredName',
        'ssn',
        'sin',
        'state',
        'stateCode',
        'status',
        'supervisor',
        'supervisorId',
        'supervisorEId',
        'terminationDate',
        'workEmail',
        'workPhone',
        'workPhonePlusExtension',
        'workPhoneExtension',
        'zipcode',
        'isPhotoUploaded',
        'standardHoursPerWeek',
        'bonusDate',
        'bonusAmount',
        'bonusReason',
        'bonusComment',
        'commissionDate',
        'commissionAmount',
        'commissionComment',
        'commissionStatus'
    ];

    /**
     * Returns the user belonging to the provided API key
     *
     * @param array $fields
     * 
     * @return \BambooHR\Api\Response
     */
    public function me($fields = null)
    {
        return $this->byId(0, $fields);
    }

    /**
     * Returns an employee identified by the given ID
     *
     * @param string $id
     * @param array $fields
     * 
     * @return \BambooHR\Api\Response
     */
    public function byId($id, $fields = null)
    {
        if (is_null($fields)) {
            $fields = self::$defaultFields;
        }

        return $this->get("employees/{$id}/", ['fields' => implode(',', $fields)]);
    }

    /**
     * Returns the employee directory
     *
     * @return \BambooHR\Api\Response
     */
    public function directory()
    {
        return $this->get("employees/directory");
    }

    /**
     * Add a new employee
     *
     * @param array $data
     * 
     * @return \BambooHR\Api\Response
     */
    public function add(array $data) {}

    /**
     * Update an existing employee identified by their ID
     *
     * @param string $id
     * @param array $data
     * 
     * @return \BambooHR\Api\Response
     */
    public function update($id, array $data) {}

    /**
     * Return a list of files associated with a given employee
     * identified by their ID
     *
     * @param string $id
     * 
     * @return \BambooHR\Api\Response
     */
    public function files($id)
    {
        return $this->get("employees/{$id}/files/view/");
    }

    /**
     * Add a new file category (folder)
     *
     * @param string $category
     * 
     * @return \BambooHR\Api\Response
     */
    public function addFileCategory(string $category) {}

    /**
     * Update an existing file for a given employee
     *
     * @param string $id Employee ID
     * @param string $fileId File ID
     * @param array $data
     * 
     * @return \BambooHR\Api\Response
     */
    public function updateFile($id, $fileId, array $data) {}

    /**
     * Delete a given file for an employee
     *
     * @param string $id Employee ID
     * @param string $fileId File ID
     *
     * @return \BambooHR\Api\Response
     */
    public function deleteFile($id, $fileId) {}

    /**
     * Download a given file for an employee
     *
     * @param string $id Employee ID
     * @param string $fileId File ID
     * 
     * @return \BambooHR\Api\Response
     */
    public function downloadFile($id, $fileId) {}

    /**
     * Upload a file to a given employee
     *
     * @param string $id Employee ID
     * @param array $data
     * 
     * @return \BambooHR\Api\Response
     */
    public function uploadFile($id, array $data) {}

}

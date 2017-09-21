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

    public function me($fields = null)
    {
        return $this->byId(0, $fields);
    }

    public function byId($id, $fields = null)
    {
        if (is_null($fields)) {
            $fields = self::$defaultFields;
        }

        return $this->get("employees/{$id}/", ['fields' => implode(',', $fields)]);
    }

    public function directory()
    {
        return $this->get("employees/directory");
    }

    public function add(array $data) {}

    public function update($id, array $data) {}

    public function remove($id) {}

    public function files($id)
    {
        return $this->get("employees/{$id}/files/view/");
    }

    public function addFileCategory(string $category) {}

    public function updateFile($id, $fileId, array $data) {}

    public function deleteFile($id, $fileId) {}

    public function downloadFile($id, $fileId) {}

    public function uploadFile($id, array $data) {}

}

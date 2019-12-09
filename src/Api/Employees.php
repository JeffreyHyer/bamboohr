<?php

namespace BambooHR\Api;

/**
 * @link https://www.bamboohr.com/api/documentation/employees.php
 */
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
     * @param array $fields
     * 
     * @return \BambooHR\Api\Response
     */
    public function add(array $fields)
    {
        $xml = "<employee>";

        foreach ($fields as $field => $value) {
            $xml .= "<field id=\"{$field}\">{$value}</field>";
        }

        $xml .= "</employee>";

        return $this->post("employees", $xml);
    }

    /**
     * Update an existing employee identified by their ID
     *
     * @param string $id
     * @param array $fields
     * 
     * @return \BambooHR\Api\Response
     */
    public function update($id, array $fields)
    {
        $xml = "<employee>";

        foreach ($fields as $field => $value) {
            $xml .= "<field id=\"{$field}\">{$value}</field>";
        }

        $xml .= "</employee>";

        return $this->post("employees/{$id}", $xml);
    }

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
    public function addFileCategory(string $category)
    {
        $xml = "<employee><category>{$category}</category></employee>";

        return $this->post("employees/files/categories", $xml);
    }

    /**
     * Update an existing file for a given employee
     *
     * @param string $id Employee ID
     * @param string $fileId File ID
     * @param array $data ['name' => string, 'categoryId' => int, 'shareWithEmployee' => 'yes|no']
     * 
     * @return \BambooHR\Api\Response
     */
    public function updateFile($id, $fileId, array $data)
    {
        $xml = "<file>";

        if (isset($data['name'])) {
            $xml .= "<name>{$data['name']}</name>";
        }

        if (isset($data['categoryId'])) {
            $xml .= "<categoryId>{$data['categoryId']}</categoryId>";
        }

        if (isset($data['shareWithEmployee'])) {
            $xml .= "<shareWithEmployee>{$data['shareWithEmployee']}</shareWithEmployee>";
        }

        $xml .= "</file>";

        return $this->post("employees/{$id}/files/{$fileId}", $xml);
    }

    /**
     * Delete a given file for an employee
     *
     * @param string $id Employee ID
     * @param string $fileId File ID
     *
     * @return \BambooHR\Api\Response
     */
    public function deleteFile($id, $fileId)
    {
        return $this->delete("employees/{$id}/files/{$fileId}");
    }

    /**
     * Download a given file for an employee
     *
     * @param string $id Employee ID
     * @param string $fileId File ID
     * 
     * @return \BambooHR\Api\Response
     */
    public function downloadFile($id, $fileId)
    {
        return $this->get("employees/{$id}/files/{$fileId}");
    }

    /**
     * Upload a file to a given employee
     *
     * @param string $id Employee ID
     * @param array $data
     * 
     * @return \BambooHR\Api\Response
     */
    public function uploadFile($id, array $data)
    {
        return $this->postFile("employees/{$id}/files", $data);
    }

    /**
     * An undocumented BambooHR API endpoint for
     * bulk importing employees.
     * 
     * NOTES:
     *  - This method is untested. Use are your own risk.
     *  - There is some limitations with this implementation of XML
     *    generation. For example, it does not support tag attributes
     *    on nested elements (within the <employee> element). It may or
     *    may not be an issue depending on your use case.
     *    
     *    e.g. use of `<termDate isNull="true"></termDate>` wouldn't work
     * 
     * @link https://github.com/BambooHR/bhr-api-php/blob/master/BambooHR/API/API.php#L954
     * @link https://github.com/BambooHR/bhr-api-php/blob/master/test_import.xml
     *
     * @param array $data [[_employee_], ...]
     * 
     * @return \BambooHR\Api\Response
     */
    public function import(array $data)
    {
        $xml = "<employees>";

        foreach ($data as $user) {
            $xml .= "<employee";
            $xml .= (isset($user['number']) ? " number=\"{$user['number']}\">" : ">");

            foreach ($user as $key => $value) {
                if ($key == "number") {
                    continue;
                }

                if (is_array($value)) {
                    $xml .= "<{$key}>";

                    foreach ($value as $vKey => $vValue) {
                        $xml .= "<{$vKey}>{$vValue}</{$vKey}>";
                    }

                    $xml .= "</{$key}>";
                } else {
                    $xml .= "<{$key}>{$value}</{$key}>";
                }
            }

            $xml .= "</employee>";
        }

        $xml .= "</employees>";

        return $this->post("employees/import", $xml);
    }

}

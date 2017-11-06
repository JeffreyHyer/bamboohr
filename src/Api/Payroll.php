<?php

namespace BambooHR\Api;

/**
 * Payroll API
 * 
 * @link https://www.bamboohr.com/api/documentation/payroll.php
 */
class Payroll extends AbstractApi
{

    /**
     * Add an employee's default withholdings
     *
     * @param string $employeeId
     * @param array $withholdings
     * 
     * @return \BambooHR\Api\Response
     */
    public function addWithholdings($employeeId, $withholdings = array())
    {
        return $this->post("employee_withholding/{$employeeId}", $withholdings);
    }

    /**
     * Get an employee's default withholdings
     *
     * @param string $employeeId
     * 
     * @return \BambooHR\Api\Response
     */
    public function getWithholdings($employeeId)
    {
        return $this->get("employee_withholding/{$employeeId}");
    }

    /**
     * Clear an employee's default withholdings
     *
     * @param string $employeeId
     * 
     * @return \BambooHR\Api\Response
     */
    public function clearWithholdings($employeeId)
    {
        return $this->delete("employee_withholding/{$employeeId}");
    }

    /**
     * Add an employee's direct deposit information
     * 
     * See the official API documentation for allowed/required fields
     * and special notes regarding usage of this endpoint.
     *
     * @param string $employeeId
     * @param array $ddInfo
     * 
     * @return \BambooHR\Api\Response
     */
    public function addDirectDeposit($employeeId, $ddInfo = array())
    {
        return $this->post("employee_direct_deposit_accounts/{$employeeId}", $ddInfo);
    }

    /**
     * Get an employee's direct deposit information
     *
     * @param string $employeeId
     * 
     * @return BambooHR\Api\Response
     */
    public function getDirectDeposit($employeeId)
    {
        return $this->get("employee_direct_deposit_accounts/{$employeeId}");
    }

    /**
     * Clear an employee's direct deposit information
     *
     * @param string $employeeId
     * 
     * @return BambooHR\Api\Response
     */
    public function clearDirectDeposit($employeeId)
    {
        return $this->delete("employee_direct_deposit_accounts/{$employeeId}");
    }

    /**
     * Add an employee's unpaid pay stubs
     *
     * @param string $employeeId
     * @param array $stubs
     * 
     * @return BambooHR\Api\Response
     */
    public function addUnpaidPayStubs($employeeId, $stubs = array())
    {
        return $this->post("employee_unpaid_pay_stubs/{$employeeId}", $stubs);
    }
    
    /**
     * Get an employee's unpaid pay stubs
     *
     * @param string $employeeId
     * 
     * @return BambooHR\Api\Response
     */
    public function getUnpaidPayStubs($employeeId)
    {
        return $this->get("employee_unpaid_pay_stubs/{$employeeId}");
    }

    /**
     * Clear an employee's unpaid pay stubs
     *
     * @param string $employeeId
     * 
     * @return BambooHR\Api\Response
     */
    public function clearUnpaidPayStubs($employeeId)
    {
        return $this->delete("employee_unpaid_pay_stubs/{$employeeId}");
    }

    /**
     * Add an employee's pay stub
     *
     * @param string $employeeId
     * @param array $stub
     * 
     * @return BambooHR\Api\Response
     */
    public function addPayStub($employeeId, $stub = array())
    {
        return $this->post("employee_pay_stub/{$employeeId}", $stub);
    }

    /**
     * Get a specific pay stub by ID
     *
     * @param string $recordId
     * 
     * @return BambooHR\Api\Response
     */
    public function getPayStub($recordId)
    {
        return $this->get("employee_pay_stub/{$recordId}");
    }

    /**
     * Delete a specific pay stub by ID
     *
     * @param string $recordId
     * 
     * @return BambooHR\Api\Response
     */
    public function deletePayStub($recordId)
    {
        return $this->delete("employee_pay_stub/{$recordId}");
    }

    /**
     * Get an employee's payroll deductions
     *
     * @param string $employeeId
     * 
     * @return BambooHR\Api\Response
     */
    public function getPayrollDeductions($employeeId)
    {
        return $this->get("payroll/deductions/{$employeeId}");
    }

}
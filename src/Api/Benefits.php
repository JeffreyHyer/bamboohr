<?php

namespace BambooHR\Api;

/**
 * Benefits API
 * 
 * @link https://www.bamboohr.com/api/documentation/benefits.php
 */
class Benefits extends AbstractApi
{

    /**
     * Get benefit coverages
     *
     * @param string $benefitCoverageId [Optional]
     * 
     * @return BambooHR\Api\Response
     */
    public function getBenefitCoverages($benefitCoverageId = null)
    {
        $benefitCoverageId = ($benefitCoverageId ? "/{$benefitCoverageId}" : "");

        return $this->get("benefitcoverages{$benefitCoverageId}");
    }

    /**
     * Get employee dependents, optionally filtered by a given employee ID
     *
     * @param string $employeeId
     * 
     * @return BambooHR\Api\Response
     */
    public function getEmployeeDependents($employeeId = null)
    {
        $employeeId = ($employeeId ? "/{$employeeId}" : "");

        return $this->get("employeedependents/{$employeeId}");
    }

    /**
     * Change an employee dependent
     *
     * @param string $dependentId
     * @param array $data
     * 
     * @return BambooHR\Api\Response
     */
    public function updateEmployeeDependent($dependentId, $data = array())
    {
        return $this->put("employeedependents/{$dependentId}", json_encode($data));
    }

    /**
     * Add an employee dependent
     *
     * @param array $data
     * 
     * @return BambooHR\Api\Response
     */
    public function addEmployeeDependent($data)
    {
        return $this->post("employeedependents", json_encode($data));
    }

    /**
     * Get benefit plans
     *
     * @param string $planId
     * 
     * @return BambooHR\Api\Response
     */
    public function getBenefitPlans($planId = null)
    {
        $planId = ($planId ? "/{$planId}" : "");

        return $this->get("benefitplans{$planId}");
    }

    /**
     * Change a benefit plan
     *
     * @param string $planId
     * @param array $data
     * 
     * @return BambooHR\Api\Response
     */
    public function updateBenefitPlan($planId, $data)
    {
        return $this->put("benefitsplans/{$planId}", json_encode($data));
    }

    /**
     * Add a benefit plan
     *
     * @param array $data
     * 
     * @return BambooHR\Api\Response
     */
    public function addBenefitPlan($data)
    {
        return $this->post("benefitsplans", json_encode($data));
    }

    /**
     * Get benefit plan coverages
     *
     * @param string $id [Optional]
     * 
     * @return BambooHR\Api\Response
     */
    public function getBenefitPlanCoverages($id)
    {
        $id = ($id ? "/{$id}" : "");

        return $this->get("benefitplancoverages{$id}");
    }

    /**
     * Change a benefit plan coverage
     *
     * @param string $id
     * @param array $data
     * 
     * @return BambooHR\Api\Response
     */
    public function updateBenefitPlanCoverage($id, $data)
    {
        return $this->put("benefitplancoverages/{$id}", json_encode($data));
    }

    /**
     * Add a benefit plan coverage
     *
     * @param [type] $data
     * @return void
     */
    public function addBenefitPlanCoverage($data)
    {
        return $this->post("benefitplancoverages", json_encode($data));
    }

    /**
     * Get benefit group(s)
     *
     * @param string $id
     * 
     * @return BambooHR\Api\Response
     */
    public function getBenefitGroup($id = null)
    {
        $id = ($id ? "/{$id}" : "");

        return $this->get("benefitgroups{$id}");
    }

    /**
     * Change a benefit group
     *
     * @param string $id
     * @param array $data
     * 
     * @return BambooHR\Api\Response
     */
    public function updateBenefitGroup($id, $data)
    {
        return $this->put("benefitgroups/{$id}", json_encode($data));
    }

    /**
     * Add a benefit group
     *
     * @param array $data
     * 
     * @return BambooHR\Api\Response
     */
    public function addBenefitGroup($data)
    {
        return $this->post("benefitgroups", json_encode($data));
    }

    /**
     * Get benefit group employee(s)
     *
     * @param string $id [Optional]
     * 
     * @return BambooHR\Api\Response
     */
    public function getBenefitGroupEmployees($id = null)
    {
        $id = ($id ? "/{$id}" : "");

        return $this->get("benefitgroupemployees{$id}");
    }

    /**
     * Add a benefit group employee
     *
     * @param array $data
     * 
     * @return BambooHR\Api\Response
     */
    public function addBenefitGroupEmployee($data)
    {
        return $this->post("benefitgroupemployees", json_encode($data));
    }

    /**
     * Get benefit group plan(s)
     *
     * @param string $id [Optional]
     * 
     * @return BambooHR\Api\Response
     */
    public function getBenefitGroupPlans($id)
    {
        $id = ($id ? "/{$id}" : "");

        return $this->get("benefitgroupplans{$id}");
    }

    /**
     * Add a benefit group plan
     *
     * @param array $data
     * 
     * @return BambooHR\Api\Response
     */
    public function addBenefitGroupPlan($data)
    {
        return $this->post("benefitgroupplans", json_encode($data));
    }

    /**
     * Get benefit group plan cost(s)
     *
     * @param string $id
     * 
     * @return BambooHR\Api\Response
     */
    public function getBenefitGroupPlanCosts($id = null)
    {
        $id = ($id ? "/{$id}" : "");

        return $this->get("benefitgroupplancosts{$id}");
    }

    /**
     * Add a benefit group plan cost
     *
     * @param array $data
     * 
     * @return BambooHR\Api\Response
     */
    public function addBenefitGroupPlanCost($data)
    {
        return $this->post("benefitgroupplancosts", json_encode($data));
    }

    /**
     * Get employee deductions by benefit plan
     *
     * @param string $planId
     * @param string $employeeId [Optional]
     * 
     * @return BambooHR\Api\Response
     */
    public function getEmployeeDeductionsByBenefitPlan($planId, $employeeId = null)
    {
        return $this->get("employee/deductions/{$planId}", ['employeeId' => $employeeId]);
    }

    /**
     *  Get plan deductions by employee
     *
     * @param string $id Employee ID
     * 
     * @return BambooHR\Api\Response
     */
    public function getPlanDeductionsByEmployee($id)
    {
        return $this->get("employee/plans/{$id}");
    }

    /**
     * Get benefit deductions for employee
     *
     * @param string $id
     * 
     * @return BambooHR\Api\Response
     */
    public function getBenefitDeductionsForEmployee($id)
    {
        return $this->get("payroll/deductions/{$id}");
    }

}
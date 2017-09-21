<?php

namespace BambooHR\Api;

class Tables extends AbstractApi
{

    public function jobInfo($employeeId = 'all')
    {
        return $this->getTable("jobInfo", $employeeId);
    }

    public function employmentStatus($employeeId = 'all')
    {
        return $this->getTable("employmentStatus", $employeeId);
    }

    public function compensation($employeeId = 'all')
    {
        return $this->getTable("compensation", $employeeId);
    }

    public function dependents($employeeId = 'all')
    {
        return $this->getTable("dependents", $employeeId);
    }

    public function emergencyContacts($employeeId = 'all')
    {
        return $this->getTable("emergencyContacts", $employeeId);
    }

    public function contacts($employeeId = 'all')
    {
        return $this->getTable("emergencyContacts", $employeeId);
    }

    public function getTable($table, $employeeId = 'all')
    {
        return $this->get("employees/{$employeeId}/tables/{$table}");
    }

    public function getTables()
    {
        return $this->get("/meta/tables/");
    }

}

<?php

namespace BambooHR\Api;

class Reports extends AbstractApi
{

    /**
     * Retrieve a company report identified by it's ID
     * 
     * @link https://www.bamboohr.com/api/documentation/employees.php#requestCompanyReport
     *
     * @param string $id
     * @param string $format [CSV|PDF|XLS|XML|JSON]
     * @param string $fd Filter duplicate fields (yes|no)
     * 
     * @return \BambooHR\Api\Response
     */
    public function companyReport($id, $format = "JSON", $fd = "yes")
    {
        return $this->get("reports/{$id}", ['format' => $format, 'fd' => $fd]);
    }

    /**
     * Retrieve a custom report containing the provided fields for all employees
     * (active AND inactive). Optionally only include employees whose fields have
     * changed since the $lastChanged date and time (ISO 8601).
     *
     * @param string $title
     * @param array $fields
     * @param string $lastChanged
     * @param string $format [CSV|PDF|XLS|XML|JSON]
     * 
     * @return \BambooHR\Api\Response
     */
    public function customReport($title, array $fields, $lastChanged = null, $format = "JSON")
    {
        $xml = "<report>";
        $xml .= "<title>{$title}</title>";

        if ($lastChanged) {
            $xml .= "<filters><lastChanged includeNull=\"no\">{$lastChanged}</lastChanged></filters>";
        }

        $xml .= "<fields>";
        
        foreach ($fields as $field) {
            $xml .= "<field id=\"{$field}\" />";
        }

        $xml .= "</fields>";
        $xml .= "</report>";

        return $this->post("reports/custom", ['format' => $format], $xml);
    }

}

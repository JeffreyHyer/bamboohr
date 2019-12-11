<?php

namespace BambooHR\Api;

class Company extends AbstractApi
{

    /**
     * Get a list of files and categories associated with the company
     *
     * @return \BambooHR\Api\Response
     */
    public function files()
    {
        return $this->get("files/view");
    }

    /**
     * Add a file category
     *
     * @param string $category
     * 
     * @return \BambooHR\Api\Response
     */
    public function addFileCategory($category)
    {
        $xml = "<files><category>{$category}</category></files>";
        
        return $this->post("files/categories", $xml);
    }

    /**
     * Update a given file
     *
     * @param string $fileId
     * @param array $data ['name' => string, 'categoryId' => integer, 'shareWithEmployee' => 'yes|no']
     * 
     * @return \BambooHR\Api\Response
     */
    public function updateFile($fileId, array $data)
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

        return $this->post("files/{$fileId}", $xml);
    }

    /**
     * Delete a given file
     *
     * @param string $fileId
     * 
     * @return \BambooHR\Api\Response
     */
    public function deleteFile($fileId)
    {
        return $this->delete("files/{$fileId}");
    }

    /**
     * Download a given file
     *
     * @param string $fileId
     * 
     * @return \BambooHR\Api\Response
     */
    public function downloadFile($fileId)
    {
        return $this->get("files/{$fileId}");
    }

    /**
     * Upload a new file
     *
     * @param array $data
     * 
     * @return \BambooHR\Api\Response
     */
    public function uploadFile(array $data)
    {
        return $this->postFile("files", $data);
    }

}

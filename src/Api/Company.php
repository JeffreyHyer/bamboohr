<?php

namespace BambooHR\Api;

class Company extends AbstractApi
{

    public function files()
    {
        return $this->get("files/view");
    }

    public function addFileCategory($category)
    {
        $xml = "<files><category>{$category}</category></files>";
        
        return $this->post("files/categories", $xml);
    }

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

    public function deleteFile($fileId)
    {
        return $this->delete("files/{$fileId}");
    }

    public function downloadFile($fileId)
    {
        return $this->get("files/{$fileId}");
    }

    public function uploadFile(array $data)
    {
        return $this->postFile("files", $data);
    }

}

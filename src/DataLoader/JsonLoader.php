<?php

namespace src\DataLoader;

class JsonLoader
{
    public function loadData($filePath)
    {
        $jsonContent = file_get_contents($filePath);
        return json_decode($jsonContent, true);
    }
}

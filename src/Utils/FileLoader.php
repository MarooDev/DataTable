<?php

namespace src\Utils;

use src\DataLoader\CsvLoader;
use src\DataLoader\JsonLoader;
use src\DataLoader\LdifLoader;

class FileLoader
{
    public function loadFile($filePath)
    {
        $extension = pathinfo($filePath, PATHINFO_EXTENSION);

        switch ($extension) {
            case 'csv':
                $loader = new CsvLoader();
                break;
            case 'json':
                $loader = new JsonLoader();
                break;
            case 'ldif':
                $loader = new LdifLoader();
                break;
            default:
                throw new \Exception("Unsupported file format: $extension");
        }

        return $loader->loadData($filePath);
    }
}

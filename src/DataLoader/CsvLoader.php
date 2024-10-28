<?php

namespace src\DataLoader;

class CsvLoader
{
    public function loadData($filePath)
    {
        $data = [];
        $headers = [];
        if (($handle = fopen($filePath, "r")) !== false) {
            $headers = fgetcsv($handle, 1000, "|") ?: ['Customer', 'Country', 'Order', 'Status', 'Group'];

            while (($row = fgetcsv($handle, 1000, "|")) !== false) {
                $data[] = array_combine($headers, $row);
            }
            fclose($handle);
        }
        return ['headers' => $headers, 'data' => $data];
    }
}

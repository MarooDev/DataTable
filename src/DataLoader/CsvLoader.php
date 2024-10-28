<?php

namespace src\DataLoader;

class CsvLoader
{
    public function loadData($filePath)
    {
        $data = [];
        if (($handle = fopen($filePath, "r")) !== false) {
            while (($row = fgetcsv($handle, 1000, ",")) !== false) {
                $data[] = [
                    'Customer' => $row[0] ?? null,
                    'Country' => $row[1] ?? null,
                    'Order' => $row[2] ?? null,
                    'Status' => $row[3] ?? null,
                    'Group' => $row[4] ?? null
                ];
            }
            fclose($handle);
        }
        return $data;
    }
}

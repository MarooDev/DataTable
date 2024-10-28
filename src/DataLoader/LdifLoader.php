<?php

namespace src\DataLoader;

class LdifLoader
{
    public function loadData($filePath)
    {
        $data = [];
        $entry = [];
        $lines = file($filePath);

        foreach ($lines as $line) {
            $line = trim($line);

            if (empty($line)) {
                if (!empty($entry)) {
                    $data[] = $entry;
                    $entry = [];
                }
                continue;
            }

            list($key, $value) = explode(":", $line, 2);
            $key = trim($key);
            $value = trim($value);

            switch ($key) {
                case 'Customer':
                    $entry['Customer'] = $value;
                    break;
                case 'Country':
                    $entry['Country'] = $value;
                    break;
                case 'Order':
                    $entry['Order'] = $value;
                    break;
                case 'Status':
                    $entry['Status'] = $value;
                    break;
                case 'Group':
                    $entry['Group'] = $value;
                    break;
            }
        }
        return $data;
    }
}

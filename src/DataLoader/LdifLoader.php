<?php

namespace src\DataLoader;

class LdifLoader
{
    public function loadData($filePath)
    {
        $data = [];
        $headers = ['Customer', 'Country', 'Order', 'Status', 'Group'];

        $fileContents = file_get_contents($filePath);
        if ($fileContents === false) {
            throw new \Exception("Failed to open LDIF file: $filePath");
        }

        $entries = explode("\n\n", $fileContents);
        foreach ($entries as $entry) {
            $entryData = [
                'Customer' => 'N/A',
                'Country' => 'N/A',
                'Order' => 'N/A',
                'Status' => 'N/A',
                'Group' => 'N/A'
            ];

            foreach (explode("\n", $entry) as $line) {
                if (strpos($line, ':') !== false) {
                    list($key, $value) = explode(':', $line, 2);
                    $key = trim($key);
                    $value = trim($value);

                    switch (strtolower($key)) {
                        case 'customer':
                            $entryData['Customer'] = $value;
                            break;
                        case 'country':
                            $entryData['Country'] = $value;
                            break;
                        case 'order':
                            $entryData['Order'] = $value;
                            break;
                        case 'status':
                            $entryData['Status'] = $value;
                            break;
                        case 'group':
                            $entryData['Group'] = $value;
                            break;
                    }
                }
            }

            $data[] = $entryData;
        }

        return [
            'headers' => $headers,
            'data' => $data
        ];
    }
}

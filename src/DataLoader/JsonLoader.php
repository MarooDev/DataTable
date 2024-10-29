<?php

namespace src\DataLoader;

class JsonLoader
{
    public function loadData($filePath)
    {
        $data = [];
        $headers = [];

        $fileContents = file_get_contents($filePath);
        if ($fileContents === false) {
            throw new \Exception("Failed to open JSON file: $filePath");
        }

        $jsonData = json_decode($fileContents, true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new \Exception("JSON decoding error: " . json_last_error_msg());
        }

        if (isset($jsonData['cols'])) {
            $headers = $jsonData['cols'];
            unset($jsonData['cols']);
        } else {
            throw new \Exception("Missing 'cols' key in JSON file");
        }

        foreach ($jsonData['data'] as $row) {
            $rowData = [];

            foreach ($headers as $index => $header) {
                if (array_key_exists($index, $row)) {
                    $rowData[$header] = $this->parseValue($row[$index]);
                } else {
                    $rowData[$header] = 'N/A';
                }
            }

            $data[] = $rowData;
        }

        return [
            'headers' => $headers,
            'data' => $data
        ];
    }

    private function parseValue($value)
    {
        if (is_array($value)) {
            return implode(', ', array_map([$this, 'parseValue'], $value));
        } elseif (is_object($value)) {
            return json_encode($value);
        } elseif (is_null($value)) {
            return 'N/A';
        } else {
            return (string)$value;
        }
    }
}

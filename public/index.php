<?php

require_once '../vendor/autoload.php';

use src\Utils\FileLoader;
use src\Services\DataAnalyzer;

$fileLoader = new FileLoader();
$dataAnalyzer = new DataAnalyzer();

$files = [
    'csv' => '../data/dataFeb-2-2017.csv',
    'json' => '../data/dataFeb-2-2017.json',
    'ldif' => '../data/dataFeb-2-2017.ldif'
];

try {
    $allData = [];
    $dataByFile = [];

    foreach ($files as $type => $file) {
        $fileData = $fileLoader->loadFile($file);

        if (isset($fileData['data']) && is_array($fileData['data'])) {
            $filteredData = array_filter($fileData['data'], function($row) {
                foreach ($row as $value) {
                    if ($value !== 'N/A') {
                        return true;
                    }
                }
                return false;
            });

            $allData = array_merge($allData, $filteredData);
            $dataByFile[$type] = $filteredData;
        } else {
            throw new Exception("Data for file {$file} could not be loaded correctly.");
        }
    }

    $headers = $fileData['headers'];
    $topOrders = $dataAnalyzer->getTopSellingOrders($allData);
    $topCountriesByGroup = $dataAnalyzer->getTopCountryByGroup($allData);
    $statusDistribution = $dataAnalyzer->getStatusDistributionByFile($dataByFile);
    $totalConsonants = $dataAnalyzer->getTotalConsonantsInCustomerNames($allData);

} catch (Exception $e) {
    $errorMessage = $e->getMessage();
}

include 'views/table.php';

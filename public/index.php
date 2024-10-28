<?php

require_once '../vendor/autoload.php';

use src\Utils\FileLoader;

$fileLoader = new FileLoader();

$files = [
    '../data/dataFeb-2-2017.csv',
    '../data/dataFeb-2-2017.json',
    '../data/dataFeb-2-2017.ldif'
];

foreach ($files as $file) {
    try {
        $data = $fileLoader->loadFile($file);
        echo "Data from file $file:\n";
        print_r($data);
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage() . "\n";
    }
    echo "\n";
}

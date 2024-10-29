<?php

namespace src\Services;

class DataAnalyzer
{
    public function getTopSellingOrders($data, $limit = 30)
    {
        $orderCounts = [];
        foreach ($data as $row) {
            $order = isset($row['Order']) && is_string($row['Order']) ? $row['Order'] : 'Unknown';
            $orderCounts[$order] = ($orderCounts[$order] ?? 0) + 1;
        }
        arsort($orderCounts);
        return array_slice($orderCounts, 0, $limit, true);
    }

    public function getTopCountryByGroup($data)
    {
        $groupCountryCounts = [];
        foreach ($data as $row) {
            $group = (isset($row['Group']) && is_string($row['Group'])) ? $row['Group'] : 'Unknown';
            $country = (isset($row['Country']) && is_string($row['Country'])) ? $row['Country'] : 'Unknown';
            $groupCountryCounts[$group][$country] = ($groupCountryCounts[$group][$country] ?? 0) + 1;
        }

        $topCountriesByGroup = [];
        foreach ($groupCountryCounts as $group => $countries) {
            $maxCount = max($countries);
            $topCountriesByGroup[$group] = implode(', ', array_keys($countries, $maxCount));
        }

        return $topCountriesByGroup;
    }

    public function getStatusDistributionByFile($dataByFile)
    {
        $statusCounts = [];
        foreach ($dataByFile as $file => $data) {
            $file = is_string($file) ? $file : 'Unknown';
            foreach ($data as $row) {
                $status = isset($row['Status']) && is_string($row['Status']) ? $row['Status'] : 'Unknown';
                $statusCounts[$status][$file] = ($statusCounts[$status][$file] ?? 0) + 1;
            }
        }

        $statusDistribution = [];
        foreach ($statusCounts as $status => $counts) {
            $maxCount = max($counts);
            $topFiles = array_keys($counts, $maxCount);
            $statusDistribution[$status] = implode(', ', $topFiles);
        }

        return $statusDistribution;
    }

    public function getTotalConsonantsInCustomerNames($data)
    {
        $totalConsonants = 0;
        foreach ($data as $row) {
            $name = isset($row['Customer']) && is_string($row['Customer']) ? str_replace(' ', '', $row['Customer']) : '';
            $totalConsonants += preg_match_all('/[bcdfghjklmnpqrstvwxyz]/i', $name);
        }
        return $totalConsonants;
    }
}

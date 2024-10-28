<?php

namespace src\Services;

class DataAnalyzer
{
    public function getTopSellingOrders($data, $limit = 30)
    {
        $orderCounts = [];
        foreach ($data as $row) {
            $order = $row['Order'] ?? 'Unknown';
            $orderCounts[$order] = ($orderCounts[$order] ?? 0) + 1;
        }
        arsort($orderCounts);
        return array_slice($orderCounts, 0, $limit, true);
    }

    public function getTopCountryByGroup($data)
    {
        $groupCountryCounts = [];
        foreach ($data as $row) {
            $group = $row['Group'] ?? 'Unknown';
            $country = $row['Country'] ?? 'Unknown';
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
            foreach ($data as $row) {
                $status = $row['Status'] ?? 'Unknown';
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
            $name = str_replace(' ', '', $row['Customer'] ?? '');
            $totalConsonants += preg_match_all('/[bcdfghjklmnpqrstvwxyz]/i', $name);
        }
        return $totalConsonants;
    }
}

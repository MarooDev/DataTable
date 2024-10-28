<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Table</title>
    <link rel="stylesheet" href="../public/styles.css">
</head>
<body>
<h1>Data Table</h1>

<?php if (isset($errorMessage)): ?>
    <p>Error: <?php echo htmlspecialchars($errorMessage); ?></p>
<?php else: ?>
<div class="table-container">
    <table>
        <thead>
        <tr>
            <?php foreach ($headers as $header): ?>
                <th><?php echo htmlspecialchars($header); ?></th>
            <?php endforeach; ?>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($allData as $row): ?>
            <tr>
                <?php foreach ($headers as $header): ?>
                    <td data-label="<?php echo htmlspecialchars($header); ?>">
                        <?php echo htmlspecialchars($row[$header] ?? 'N/A'); ?>
                    </td>
                <?php endforeach; ?>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<h2>Top 30 Best-Selling Orders</h2>
    <ul class="top-orders">
    <?php foreach ($topOrders as $order => $count): ?>
        <li><?php echo htmlspecialchars($order); ?>: <?php echo $count; ?> sales</li>
    <?php endforeach; ?>
    </ul>

<h2>Top Country by Group</h2>
    <ul class="top-orders">
    <?php foreach ($topCountriesByGroup as $group => $countries): ?>
        <li>Group <?php echo htmlspecialchars($group); ?>: <?php echo htmlspecialchars($countries); ?></li>
    <?php endforeach; ?>
    </ul>

<h2>Status Distribution by File</h2>
    <ul class="top-orders">
    <?php foreach ($statusDistribution as $status => $files): ?>
        <li>Status <?php echo htmlspecialchars($status); ?>: <?php echo htmlspecialchars($files); ?></li>
    <?php endforeach; ?>
    </ul>

    <h2>Total Consonants in Customer Names</h2>
    <p><?php echo $totalConsonants; ?> consonants</p>
<?php endif; ?>
</body>
</html>

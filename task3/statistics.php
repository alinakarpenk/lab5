<?php
try {
    $dsn = "mysql:host=localhost;dbname=company_db";
    $pdo = new PDO($dsn, "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $avg_salary_stmt = $pdo->query("SELECT AVG(salary) AS avg_salary FROM employees");
    $avg_salary = $avg_salary_stmt->fetch(PDO::FETCH_ASSOC);
    $position_count_stmt = $pdo->query("SELECT position, COUNT(*) AS count FROM employees GROUP BY position");
    $position_count = $position_count_stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Помилка: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Статистика</title>
</head>
<body>
<h2>Статистика</h2>
<h3>Середня зарплата всіх працівників: <?php echo $avg_salary['avg_salary']; ?></h3>
<h3>Кількість працівників на кожній посаді:</h3>
<ul>
    <?php foreach ($position_count as $row): ?>
        <li><?php echo $row['position'] . ': ' . $row['count']; ?></li>
    <?php endforeach; ?>
</ul>
</body>
</html>


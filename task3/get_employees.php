<?php
try {
    $dsn = "mysql:host=localhost;dbname=company_db";
    $pdo = new PDO($dsn, "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $pdo->query("SELECT * FROM employees");
    $employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Помилка: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список працівників</title>
    <style>

        table{
            border:1px solid black;
        }
        tr,th{
            border:1px solid black;
            border-collapse: collapse;
        }

    </style>
</head>
<body>
<h2>Список працівників</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Ім'я</th>
        <th>Посада</th>
        <th>Зарплата</th>
    </tr>
    <?php foreach ($employees as $employee): ?>
        <tr>
            <td><?php echo $employee['id']; ?></td>
            <td><?php echo $employee['name']; ?></td>
            <td><?php echo $employee['position']; ?></td>
            <td><?php echo $employee['salary']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<p><a href="add_employee.php">Додати нового працівника через форму</a></p>
<p><a href="edit_employee.php">Редагувати дані про користувача</a></p>

</body>
</html>


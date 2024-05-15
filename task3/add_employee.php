<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];

    try {
        $dsn = "mysql:host=localhost;dbname=company_db";
        $pdo = new PDO($dsn, "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare("INSERT INTO employees (name, position, salary) VALUES (:name, :position, :salary)");
        $stmt->execute(['name' => $name, 'position' => $position, 'salary' => $salary]);
        echo "Новий працівник доданий успішно";
    } catch (PDOException $e) {
        echo "Помилка: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Додати працівника</title>
</head>
<body>
<h2>Додати працівника</h2>
<form method="POST">
    <label for="name">Ім'я:</label><br>
    <input type="text" id="name" name="name"><br>
    <label for="position">Посада:</label><br>
    <input type="text" id="position" name="position"><br>
    <label for="salary">Зарплата:</label><br>
    <input type="text" id="salary" name="salary"><br><br>
    <input type="submit" value="Додати працівника">
</form>
</body>
</html>


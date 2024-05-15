<?php

try {
    $dsn = "mysql:host=localhost;dbname=lab5";
    $pdo = new PDO($dsn, "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (isset($_POST['add_record'])) {
        $add_name = $_POST['add_name'];
        $add_price = $_POST['add_price'];
        $add_count = $_POST['add_count'];
        $stmt = $pdo->prepare("INSERT INTO tov (name, price, count) VALUES (:name, :price, :count)");
        $stmt->execute(['name' => $add_name, 'price' => $add_price, 'count' => $add_count]);
        echo "Новий продукт доданий успішно";
    }
    if (isset($_POST['delete_record'])) {
        $delete_id = $_POST['delete_id'];
        $stmt = $pdo->prepare("DELETE FROM tov WHERE id=:id");
        $stmt->execute(['id' => $delete_id]);
        echo "Запис з ID $delete_id вилучено успішно";
    }
} catch (PDOException $e) {
    echo "Помилка: " . $e->getMessage();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <form action="index.php" method="POST">
    <label for="exit">Назад</label><br>
    <input type="submit" name="exit" value="Назад">
</form>
</body>
</html>
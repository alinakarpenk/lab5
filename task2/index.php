<?php
try {
    $dsn = "mysql:host=localhost;dbname=lab5";
    $pdo = new PDO($dsn, "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT * FROM tov");
    $tov = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Помилка: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список продуктів</title>
    <style>

        table {
            border: 1px solid black;
        }

        tr, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 5px;
        }

    </style>
</head>
<body>
<h2>Список продуктів</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Назва</th>
        <th>Ціна</th>
        <th>Кількість</th>
    </tr>
    <?php foreach ($tov as $products): ?>
        <tr>
            <td><?php echo $products['id']; ?></td>
            <td><?php echo $products['name']; ?></td>
            <td><?php echo $products['price']; ?></td>
            <td><?php echo $products['count']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<h2>Форма для додавання та вилучення записів</h2>
<form action="insert.php" method="POST">
    <label for="add_name">Назва продукту:</label><br>
    <input type="text" id="add_name" name="add_name"><br>
    <label for="add_price">Ціна:</label><br>
    <input type="text" id="add_price" name="add_price"><br>
    <label for="add_count">Кількість:</label><br>
    <input type="text" id="add_count" name="add_count"><br><br>
    <input type="submit" name="add_record" value="Додати запис">
</form>

<form action="insert.php" method="POST">
    <label for="delete_id">Номер запису для вилучення:</label><br>
    <input type="text" id="delete_id" name="delete_id"><br><br>
    <input type="submit" name="delete_record" value="Вилучити запис">
</form>



</body>
</html>


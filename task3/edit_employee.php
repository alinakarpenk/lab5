<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    try {
        $dsn = "mysql:host=localhost;dbname=company_db";
        $pdo = new PDO($dsn, "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("UPDATE employees SET name=:name, position=:position, salary=:salary WHERE id=:id");
        $stmt->execute(['name' => $name, 'position' => $position, 'salary' => $salary, 'id' => $id]);

        echo "Запис про працівника з ID $id успішно оновлено";
    } catch (PDOException $e) {
        echo "Помилка: " . $e->getMessage();
    }
} elseif(isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $dsn = "mysql:host=localhost;dbname=company_db";
        $pdo = new PDO($dsn, "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare("SELECT * FROM employees WHERE id=:id");
        $stmt->execute(['id' => $id]);
        $employee = $stmt->fetch(PDO::FETCH_ASSOC);
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
    <title>Редагувати працівника</title>
</head>
<body>
<h2>Редагувати працівника</h2>
<form method="POST">
    <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">
    <label for="name">Ім'я:</label><br>
    <input type="text" id="name" name="name" value="<?php echo $employee['name']; ?>"><br>
    <label for="position">Посада:</label><br>
    <input type="text" id="position" name="position" value="<?php echo $employee['position']; ?>"><br>
    <label for="salary">Зарплата:</label><br>
    <input type="text" id="salary" name="salary" value="<?php echo $employee['salary']; ?>"><br><br>
    <input type="submit" name="submit" value="Зберегти зміни">
</form>
</body>
</html>


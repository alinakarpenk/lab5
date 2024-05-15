<?php
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    try {
        $dsn = "mysql:host=localhost;dbname=company_db";
        $pdo = new PDO($dsn, "root", "");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $pdo->prepare("DELETE FROM employees WHERE id=:id");
        $stmt->execute(['id' => $id]);
        echo "Запис про працівника з ID $id видалено";
    } catch (PDOException $e) {
        echo "Помилка: " . $e->getMessage();
    }
}
?>


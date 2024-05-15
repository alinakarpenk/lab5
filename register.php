<?php
session_start();
try {
    $dsn = "mysql:host=localhost;dbname=lab5";
    $pdo = new PDO($dsn, "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Помилка з'єднання з базою даних: " . $e->getMessage());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    try {
        $check_query = "SELECT * FROM user WHERE username=:username";
        $stmt = $pdo->prepare($check_query);
        $stmt->execute(['username' => $username]);
        if ($stmt->rowCount() > 0) {
            echo "Користувач з таким логіном вже існує";
        } else {
            $insert_query = "INSERT INTO user (username, password) VALUES (:username, :password)";
            $stmt = $pdo->prepare($insert_query);
            $stmt->execute(['username' => $username, 'password' => $password]);
            echo "Реєстрація пройшла успішно";
        }
    } catch (PDOException $e) {
        echo "Помилка: " . $e->getMessage();
    }
}


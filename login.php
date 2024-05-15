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
    if(isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];

        try {
            $check_query = "SELECT * FROM user WHERE username=:username AND password=:password";
            $stmt = $pdo->prepare($check_query);
            $stmt->execute(['username' => $username, 'password' => $password]);
            if ($stmt->rowCount() == 1) {
                $_SESSION['authenticated'] = true;
                echo "Ви успішно увійшли на сайт";
            } else {
                echo "Неправильний логін або пароль";
            }
        } catch (PDOException $e) {
            echo "Помилка: " . $e->getMessage();
        }
    } elseif(isset($_POST['update'])) {
        $new_username = $_POST['new_username'];
        $new_password = $_POST['new_password'];
        $user_id = $_SESSION['id'];

        try {
            $update_query = "UPDATE user SET username=:username, password=:password WHERE id=:id";
            $stmt = $pdo->prepare($update_query);
            $stmt->execute(['username' => $new_username, 'password' => $new_password, 'id' => $user_id]);

            echo "Дані користувача успішно оновлено";
        } catch (PDOException $e) {
            echo "Помилка: " . $e->getMessage();
        } }
    elseif(isset($_POST['logout'])) {
        session_unset();
        session_destroy();
        echo "Ви вийшли з системи";
    }
    elseif(isset($_POST['delete'])) {
        $user_id = $_SESSION['id'];
        try {
            $delete_query = "DELETE FROM user WHERE id=:id";
            $stmt = $pdo->prepare($delete_query);
            $stmt->execute(['id' => $user_id]);

            session_unset();
            session_destroy();
            echo "Користувач успішно видалений";
        } catch (PDOException $e) {
            echo "Помилка: " . $e->getMessage();
        }
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Зміна даних користувача</title>
</head>
<body>
<h2>Зміна даних користувача</h2>
<form method="POST">
    <label for="new_username">Нове ім'я користувача:</label><br>
    <input type="text" id="new_username" name="new_username"><br>
    <label for="new_password">Новий пароль:</label><br>
    <input type="password" id="new_password" name="new_password"><br><br>
    <input type="submit" name="update" value="Оновити дані">
    <input type="submit" name="logout" value="Вийти">
    <input type="submit" name="delete" value="Видалити профіль">
</form>
</body>
</html>

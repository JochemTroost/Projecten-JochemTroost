<?php
session_start();
require "dbconn.php";

if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    try {
        $query = "SELECT id, first_name, state, email, password FROM registrations WHERE email = :email";
        $query_run = $db_connection->prepare($query);
        $query_run->execute([":email" => $email]);

        $user = $query_run->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['first_name'] = $user['first_name'];
                $_SESSION['infix'] = $user['infix'];
                $_SESSION['last_name'] = $user['last_name'];
                $_SESSION['state'] = $user['state'];

                $_SESSION['statusMsg'] = "✅ Inloggen geslaagd!";
                $_SESSION['statusClass'] = "success";
                header('Location: index.php');
              
            } else {
                $_SESSION['statusMsg'] = "❌ Geen account gevonden met de opgegeven gegevens.";
                $_SESSION['statusClass'] = "error";
                header('Location: login.php');
                exit();
            }
        } else {
            $_SESSION['statusMsg'] = "❌ Geen account gevonden met de opgegeven gegevens.";
            $_SESSION['statusClass'] = "error";
            header('Location: login.php');
            exit();
        }
    } catch (PDOException $e) {
        error_log("Database Login Error: " . $e->getMessage());
        $_SESSION['statusMsg'] = "❌ Er is een fout opgetreden. Probeer het later opnieuw. ". $e;
        $_SESSION['statusClass'] = "error";
        header('Location: login.php');
        exit();
    }
}
?>

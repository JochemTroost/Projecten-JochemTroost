<?php
session_start();
require "dbconn.php";


if (!isset($_SESSION['id'])) {
    $_SESSION['statusMsg'] = "❌ U moet ingelogd zijn om uw wachtwoord te wijzigen.";
    $_SESSION['statusClass'] = "error";
    header('Location: login.php');
    exit();
}

if (isset($_POST["edit"])) {
    $oldpassword = $_POST["oldpassword"];
    $firstpassword = $_POST["firstpassword"];
    $secondpassword = $_POST["secondpassword"];
    $id = $_SESSION['id']; 

    if ($firstpassword === $secondpassword) {
        $newpassword = password_hash($secondpassword, PASSWORD_DEFAULT);

        try {
       
            $query = "SELECT password FROM registrations WHERE id = :id";
            $query_run = $db_connection->prepare($query);
            $query_run->execute([":id" => $id]);

            $user = $query_run->fetch(PDO::FETCH_ASSOC);

            if ($user) {
                if (password_verify($oldpassword, $user['password'])) {
                    try {
                      
                        $update_query = "UPDATE registrations SET password = :password WHERE id = :id";
                        $update_stmt = $db_connection->prepare($update_query);
                        $update_stmt->execute([
                            ":password" => $newpassword,
                            ":id" => $id
                        ]);

                        $_SESSION['statusMsg'] = "✅ Wachtwoord succesvol gewijzigd!";
                        $_SESSION['statusClass'] = "success";
                        header('Location: acc.php');
                        exit();
                    } catch (PDOException $e) {
                        error_log("Database Update Error: " . $e->getMessage());
                        $_SESSION['statusMsg'] = "❌ Er is een fout opgetreden. Probeer het later opnieuw.";
                        $_SESSION['statusClass'] = "error";
                        header('Location: login.php');
                        exit();
                    }
                } else {
                    $_SESSION['statusMsg'] = "❌ Oud wachtwoord is onjuist.";
                    $_SESSION['statusClass'] = "error";
                    header('Location: acc.php');
                    exit();
                }
            } else {
                $_SESSION['statusMsg'] = "❌ Gebruiker niet gevonden.";
                $_SESSION['statusClass'] = "error";
                header('Location: login.php');
                exit();
            }
        } catch (PDOException $e) {
            error_log("Database Error: " . $e->getMessage());
            $_SESSION['statusMsg'] = "❌ Er is een fout opgetreden. Probeer het later opnieuw.";
            $_SESSION['statusClass'] = "error";
            header('Location: login.php');
            exit();
        }
    } else {
        $_SESSION['statusMsg'] = "❌ De nieuwe wachtwoorden komen niet overeen.";
        $_SESSION['statusClass'] = "error";
        header('Location: acc.php');
        exit();
    }
}

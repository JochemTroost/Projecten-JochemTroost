<?php
session_start();
require "../dbconn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST["first_name"]);
    $infix = trim($_POST["infix"]);
    $last_name = trim($_POST["last_name"]);
    $age = trim($_POST["age"]);
    $email = trim($_POST["email"]);
    $phone_number = trim($_POST["phone_nuber"]); 
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    try {
      
        $check_query = "SELECT COUNT(*) FROM registrations WHERE email = :email";
        $check_stmt = $db_connection->prepare($check_query);
        $check_stmt->execute([':email' => $email]);
        $email_exists = $check_stmt->fetchColumn();

        if ($email_exists) {
            $_SESSION["statusMsg"] = "❌ Er bestaat al een account met dit e-mailadres.";
            $_SESSION["statusClass"] = "error";
            header("location: ../../../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/CRUD_users/00_create_client.php");
            exit(); 
        } else {
          
            $query = "INSERT INTO registrations (first_name, infix, last_name, age, email, phone_number, state, password) 
                      VALUES (:first_name, :infix, :last_name, :age, :email, :phone_number, :state, :password)";
            
            $query_run = $db_connection->prepare($query);
            $query_execute = $query_run->execute([
                ":first_name" => $first_name,
                ":infix" => $infix,
                ":last_name" => $last_name,
                ":age" => $age,
                ":email" => $email,
                ":phone_number" => $phone_number, 
                ":state" => 0,
                ":password" => $password
            ]);

            if ($query_execute) {
                $_SESSION["statusMsg"] = "✅ Account succesvol aangemaakt!";
                $_SESSION["statusClass"] = "success";
            } else {
                $_SESSION["statusMsg"] = "❌ Registratie mislukt, probeer opnieuw.";
                $_SESSION["statusClass"] = "error";
            }
        }

        header("location: ../../../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/CRUD_users/00_create_client.php");
        exit();
    } catch (PDOException $e) {
        error_log("Database Insert Error: " . $e->getMessage());
        $_SESSION["statusMsg"] = "❌ Er is een fout opgetreden";
        $_SESSION["statusClass"] = "error";
        header("location: ../../../../../../Project-p3-Escaperoom/Bestanden/inloggen_test/CRUD_users/00_create_client.php");
        exit();
    }
}
?>

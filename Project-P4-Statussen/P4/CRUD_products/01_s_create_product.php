<?php
session_start();
require "../dbconn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST["name"]);
    $description = trim($_POST["description"]);
    $price = trim($_POST["price"]);
    $state = isset($_POST["state"]) ? trim($_POST["state"]) : 2; 

    try {
        // Controleer of een product met dezelfde naam al bestaat
        $check_query = "SELECT COUNT(*) FROM products WHERE name = :name";
        $check_stmt = $db_connection->prepare($check_query);
        $check_stmt->execute([':name' => $name]);
        $product_exists = $check_stmt->fetchColumn();

        if ($product_exists) {
            $_SESSION["statusMsg"] = "❌ Er bestaat al een product met deze naam.";
            $_SESSION["statusClass"] = "error";
        } else {
            // Product invoegen in de database
            $query = "INSERT INTO products (name, description, price, state) 
                      VALUES (:name, :description, :price, :state)";
            $query_run = $db_connection->prepare($query);
            $query_execute = $query_run->execute([
                ":name" => $name,
                ":description" => $description,
                ":price" => $price,
                ":state" => $state
            ]);

            if ($query_execute) {
                $_SESSION["statusMsg"] = "✅ Product succesvol toegevoegd!";
                $_SESSION["statusClass"] = "success";
            } else {
                $_SESSION["statusMsg"] = "❌ Toevoegen mislukt, probeer opnieuw.";
                $_SESSION["statusClass"] = "error";
            }
        }

        // Redirect naar het productoverzicht
        header("location: ../CRUD_products/00_read_products.php");
        exit();
    } catch (PDOException $e) {
        error_log("Database Insert Error: " . $e->getMessage());
        $_SESSION["statusMsg"] = "❌ Er is een fout opgetreden.";
        $_SESSION["statusClass"] = "error";
        header("location: ../CRUD_products/01_read_products.php");
        exit();
    }
}

<?php



if (isset($_SESSION["id"])) {
} else {
    header('location: no_access.php');
}
?>
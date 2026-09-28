<?php
$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "tip-project";

try {
    $conn = new PDO("mysql:host=$localhost;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

?>
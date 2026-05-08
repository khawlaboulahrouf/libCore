<?php
$dsn = "mysql:host=localhost;dbname=libcore;charset=utf8";
$user = "root";
$password = "";

try {
    $pdo = new PDO($dsn, $user, $password);

    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch(PDOException $e) {
    die("Erreur : " . $e->getMessage());
}
?>
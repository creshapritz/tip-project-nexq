<?php
    require_once __DIR__ . '/../vendor/autoload.php';
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
    $dotenv->load();

    $allows_origin = $_ENV['ALLOWS_ORIGIN'];
?>
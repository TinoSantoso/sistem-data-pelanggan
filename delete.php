<?php
    require_once 'database.php';
    require_once 'pelanggan.php';

    $database = new Database();
    $db = $database->getConnection();

    $pelanggan = new Pelanggan($db);

    $pelanggan->id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Missing ID.');
    $pelanggan->delete();

    header("Location: index.php");
    exit;
?>
<?php
    /** @var mysqli $db */
    require_once 'database.php';
    $db = mysqli_connect($host, $user, $password, $database)
    or die("Error: " . mysqli_connect_error());

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    $delete = "DELETE FROM units WHERE id = $id";

    $query = mysqli_query($db, $delete)
    or die('Error ' . mysqli_error($db) . ' with query ' . $delete);

    mysqli_close($db);

    header('Location: index.php');
    exit;


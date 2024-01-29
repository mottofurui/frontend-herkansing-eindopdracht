<?php
session_start();

if (!empty($_SESSION)) {
    $login = true;
} else {
    $login = false;
}
    require_once 'includes/database.php';
    $db = mysqli_connect($host, $user, $password, $database)
    or die("Error: " . mysqli_connect_error());

    $query = "SELECT * FROM units";

    $result = mysqli_query($db, $query)
    or die('Error '.mysqli_error($db).' with query '.$query);

    while($row = mysqli_fetch_assoc($result))

    $units[] = $row;

    mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Document</title>
</head>
<body>
    <a href="create.php">Create</a>
    <a href="register.php">Register</a>
        <?php if ($login) { ?>
            <a href="logout.php">Log Out</a>
        <?php } else { ?>
            <a href="login.php">Login</a>
        <?php } ?>
    <table class = "table">
        <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Structure</th>
            <th>Armor</th>
            <th>Damage</th>
            <th>Supply</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($units as $index => $unit) { ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $unit['unit_name'] ?></td>
                <td><?= $unit['spawn_structure'] ?></td>
                <td><?= $unit['armor'] ?></td>
                <td><?= $unit['damage'] ?></td>
                <td><?= $unit['supply'] ?></td>
                <td><a href="edit.php?id=<?= $unit['id'] ?>">Update</a></td>
                <td><a href="delete.php?id=<?= $unit['id'] ?>">Delete</a></td>
            </tr>
        <?php } ?>
        </tbody>
        <tfoot>
        <tr>
            <td colspan="9" class="has-text-centered">&copy; Property of Nestor inc</td>
        </tr>
        </tfoot>
    </table>
</body>
</html>

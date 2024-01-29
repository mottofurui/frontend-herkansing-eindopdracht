<?php
    if(isset($_POST['submit'])) {
    /** @var mysqli $db */
    require_once 'database.php';
    $db = mysqli_connect($host, $user, $password, $database)
    or die("Error: " . mysqli_connect_error());

    $errorMessage = 'This field is required';
    $submit = false;
    $credentials = ['unitName', 'spawnStructure', 'armor', 'damage', 'supply'];
    $succes = false;


    $unitName = htmlentities($_POST['unitName']);
    $spawnStructure = htmlentities($_POST['spawnStructure']);
    $armor = htmlentities($_POST['armor']);
    $damage = htmlentities($_POST['damage']);
    $supply = htmlentities($_POST['supply']);

    foreach ($credentials as $credential) {
        if ($_POST[$credential] == '') {
            $submit = false;
        } else {
            $submit = true;
        }
    }

    if ($submit) {
        $insert = "INSERT INTO units (unit_name, spawn_structure, damage, armor, supply)
                VALUES ('$unitName', '$spawnStructure', '$damage', '$armor', '$supply')";

        $result = mysqli_query($db, $insert)
        or die('Error ' . mysqli_error($db) . ' with query ' . $insert);

        $succes = true;
    }
    if ($succes) {
        header('Location: index.php');
        exit;
    }
    mysqli_close($db);
    }

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>All Protoss Units</title>
</head>
<body>
<section class="section">
    <div class="container content">
        <h2 class="title">Add A Unit</h2>

        <section class="columns">
            <form class="column is-6" action="" method="post">

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="unitName">Unit name</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="unitName" type="text" name="unitName" value="<?= $unitName ?? '' ?>"/>
                                <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                            </div>
                            <p class="help is-danger">
                                <?php   if (isset($_POST['submit'])) {
                                            if ($_POST['unitName'] == '') {
                                              echo $errorMessage;
                                            }
                                        }?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="spawnStructure">Spawn Structure</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="spawnStructure" type="text" name="spawnStructure" value="<?= $spawnStructure ?? '' ?>"/>
                                <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                            </div>
                            <p class="help is-danger">
                                <?php         if (isset($_POST['submit'])) {
                                if ($_POST['spawnStructure'] == '') {
                                echo $errorMessage;
                                }
                                }?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="damage">Damage</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="damage" type="text" name="damage" value="<?= $damage ?? '' ?>"/>
                                <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                            </div>
                            <p class="help is-danger">
                                <?php         if (isset($_POST['submit'])) {
                                    if ($_POST['damage'] == '') {
                                        echo $errorMessage;
                                    }
                                }?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="armor">Armor</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="armor" type="text" name="armor" value="<?= $armor ?? '' ?>"/>
                                <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
                            </div>
                            <p class="help is-danger">
                                <?php         if (isset($_POST['submit'])) {
                                    if ($_POST['armor'] == '') {
                                        echo $errorMessage;
                                    }
                                }?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="supply">Supply</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="supply" type="text" name="supply" value="<?= $supply ?? '' ?>"/>
                                <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
                            </div>
                            <p class="help is-danger">
                                <?php      if (isset($_POST['submit'])) {
                                    if ($_POST['supply'] == '') {
                                        echo $errorMessage;
                                    }
                                }?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal"></div>
                    <div class="field-body">
                        <button class="button is-link is-fullwidth" type="submit" name="submit">Register</button>
                    </div>
                </div>

            </form>
        </section>

    </div>
</section>
</body>
</html>
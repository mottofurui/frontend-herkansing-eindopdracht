<?php
    /** @var mysqli $db */
    require_once 'includes/database.php';
    $db = mysqli_connect($host, $user, $password, $database)
    or die("Error: " . mysqli_connect_error());

    if (isset($_GET['id'])) {
        $id =  $_GET['id'];

        if(!isset($_POST['submit'])) {
            $query = "SELECT * FROM users WHERE id = '$id'";
            $result = mysqli_query($db, $query);
            $user = mysqli_fetch_assoc($result);
        }

        if (isset($_POST['submit'])) {
            $unitName = $_POST['unitName'];
            $spawnStructure = $_POST['spawnStructure'];
            $armor = $_POST['armor'];
            $damage = $_POST['damage'];
            $supply = $_POST['supply'];

            if ($unitName === '') {
                $errors['unit_name'] = "Dit veld moet ingevuld zijn!";
            }
            if ($spawnStructure === '') {
                $errors['spawn_structure'] = "Dit veld moet ingevuld zijn!";
            }
            if ($armor === '') {
                $errors['armor'] = "Dit veld moet ingevuld zijn!";
            }
            if ($damage === '') {
                $errors['damage'] = "Dit veld moet ingevuld zijn!";
            }
            if ($supply === '') {
                $errors['supply'] = "Dit veld moet ingevuld zijn!";
            }

            $query = "UPDATE units 
                SET unit_name='$unitName', 
                    spawn_structure='$spawnStructure', 
                    armor='$armor', 
                    damage='$damage', 
                    supply='$supply' 
               WHERE id = '$id'";
            $result = mysqli_query($db, $query)
            or die('Error ' . mysqli_error($db) . ' with query ' . $query);

            header('Location: index.php');
            exit;
        }
        mysqli_close($db);

    } else {
        header('Location: index.php');
        exit;
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
        <h2 class="title">Edit This Unit</h2>

        <section class="columns">
            <form class="column is-6" action="" method="post">

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="unitName">Unit name</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="unitName" type="text" name="unitName" value="<?= $oldUnitName ?? '' ?>" required/>
                                <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                            </div>
                            <p class="help is-danger">
                                <?= $errors['unit_name'] ?? '' ?>
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
                                <input class="input" id="spawnStructure" type="text" name="spawnStructure" value="<?= $oldSpawnStructure ?? '' ?>" required/>
                                <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                            </div>
                            <p class="help is-danger">
                                <?= $errors['spawn_structure'] ?? '' ?>
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
                                <input class="input" id="damage" type="text" name="damage" value="<?= $oldDamage ?? '' ?>" required/>
                                <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                            </div>
                            <p class="help is-danger">
                                <?= $errors['damage'] ?? '' ?>
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
                                <input class="input" id="armor" type="text" name="armor" value="<?= $oldArmor ?? '' ?>" required/>
                                <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
                            </div>
                            <p class="help is-danger">
                                <?= $errors['armor'] ?? '' ?>
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
                                <input class="input" id="supply" type="text" name="supply" value="<?= $oldSupply ?? '' ?>" required/>
                                <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
                            </div>
                            <p class="help is-danger">
                                <?= $errors['supply'] ?? '' ?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="field is-horizontal">
                    <div class="field-label is-normal"></div>
                    <div class="field-body">
                        <button class="button is-link is-fullwidth" type="submit" name="submit">Update</button>
                    </div>
                </div>

            </form>
        </section>

    </div>
</section>
</body>
</html>

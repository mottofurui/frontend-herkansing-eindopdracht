<?php

if(isset($_POST['submit'])) {
    /** @var mysqli $db */
    require_once 'includes/database.php';
    $db = mysqli_connect($host, $user, $password, $database)
    or die("Error: " . mysqli_connect_error());

    $errorMessage = 'This field is required';
    $submit = false;
    $credentials = ['email', 'password', 'firstName', 'lastName'];
    $succes = false;

    $email = htmlentities($_POST['email']);
    $password = htmlentities($_POST['password']);
    $safePassword = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $firstName = htmlentities($_POST['firstName']);
    $lastName = htmlentities($_POST['lastName']);

    foreach ($credentials as $credential) {
        if ($_POST[$credential] == '') {
            $submit = false;
        } else {
            $submit = true;
        }
    }

    if ($submit) {
        $query = "INSERT INTO users (email, password, first_name, last_name)
                VALUES ('$email', '$safePassword', '$firstName', '$lastName')";

        $result = mysqli_query($db, $query)
        or die('Error ' . mysqli_error($db) . ' with query ' . $query);

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
        <h2 class="title">Register With Email</h2>

        <section class="columns">
            <form class="column is-6" action="" method="post">

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="email">Email</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="email" type="email" name="email" value="<?= $email ?? '' ?>"/>
                                <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                            </div>
                            <p class="help is-danger">
                                <?php   if (isset($_POST['submit'])) {
                                    if ($_POST['email'] == '') {
                                        echo $errorMessage;
                                    }
                                }?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="password">Password</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="password" type="password" name="password" value="<?= $password ?? '' ?>"/>
                                <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                            </div>
                            <p class="help is-danger">
                                <?php         if (isset($_POST['submit'])) {
                                    if ($_POST['password'] == '') {
                                        echo $errorMessage;
                                    }
                                }?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="firstName">First Name</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="firstName" type="text" name="firstName" value="<?= $firstName ?? '' ?>"/>
                                <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                            </div>
                            <p class="help is-danger">
                                <?php         if (isset($_POST['submit'])) {
                                    if ($_POST['firstName'] == '') {
                                        echo $errorMessage;
                                    }
                                }?>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="field is-horizontal">
                    <div class="field-label is-normal">
                        <label class="label" for="lastName">Last Name</label>
                    </div>
                    <div class="field-body">
                        <div class="field">
                            <div class="control has-icons-left">
                                <input class="input" id="lastName" type="text" name="lastName" value="<?= $lastName ?? '' ?>"/>
                                <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>
                            </div>
                            <p class="help is-danger">
                                <?php         if (isset($_POST['submit'])) {
                                    if ($_POST['lastName'] == '') {
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

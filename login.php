<?php
session_start();
//establishes connection to the database
/** @var mysqli $db */
require_once 'includes/database.php';
$db = mysqli_connect($host, $user, $password, $database)
or die("Error: " . mysqli_connect_error());


if (!empty($_SESSION)) {
    header('Location: index.php');
    exit;
} else {
    if (isset($_POST['submit'])) {

        $email = $_POST['email'];
        $password = $_POST['password'];

        if ($email === '') {
            $errors['email'] = "Required";
        }
        if ($password === '') {
            $errors['password'] = "Required";
        }

        if ($email !== '' && $password !== '') {

            $query = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($db, $query);
            $user = mysqli_fetch_assoc($result);

            if (password_verify($password, $user['password'])) {
                if ($email == $user['email']) {

                    $_SESSION['id'] = $user['id'];

                    header('Location: index.php');
                    exit;
                } else {
                    $errors['loginFailed'] = "email or password is incorrect";
                }

            } else {
                $errors['loginFailed'] = "email or password is incorrect";
            }
        }

    }
}
mysqli_close($db);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.4/css/bulma.min.css">
    <title>Log in</title>
</head>
<body>
<section class="section">
    <div class="container content">
        <h2 class="title">Log in</h2>

            <section class="columns">
                <form class="column is-6" action="" method="post">

                    <div class="field is-horizontal">
                        <div class="field-label is-normal">
                            <label class="label" for="email">Email</label>
                        </div>
                        <div class="field-body">
                            <div class="field">
                                <div class="control has-icons-left">
                                    <input class="input" id="email" type="text" name="email" value="<?= $email ?? '' ?>" />
                                    <span class="icon is-small is-left"><i class="fas fa-envelope"></i></span>
                                </div>
                                <p class="help is-danger">
                                    <?= $errors['email'] ?? '' ?>
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
                                    <input class="input" id="password" type="password" name="password"/>
                                    <span class="icon is-small is-left"><i class="fas fa-lock"></i></span>

                                    <?php if(isset($errors['loginFailed'])) { ?>
                                        <div class="notification is-danger">
                                            <button class="delete"></button>
                                            <?=$errors['loginFailed']?>
                                        </div>
                                    <?php } ?>

                                </div>
                                <p class="help is-danger">
                                    <?= $errors['password'] ?? '' ?>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="field is-horizontal">
                        <div class="field-label is-normal"></div>
                        <div class="field-body">
                            <button class="button is-link is-fullwidth" type="submit" name="submit">Log in With Email</button>
                        </div>
                    </div>

                </form>
            </section>

    </div>
</section>
</body>
</html>

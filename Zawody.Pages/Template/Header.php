<?php
if (isset($_POST['wyloguj'])) {
    unset($_COOKIE['user_id']);
    unset($_COOKIE['is_admin']);
    setcookie('user_id', null, -1, '/');
    setcookie('is_admin', null, -1, '/');
    header('Location: ../SignIn/SignIn.php');
}
?>


<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <style>
        body {
            background-image: url('/projektphp/wwwroot/img/bg.jpg');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100" style="font-family: 'Roboto', sans-serif;">
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-4 px-3 justify-content-between">
            <a class="navbar-brand" href="../Home/Competitions.php">
                <img src="/projektphp/wwwroot/img/logo.png" width="30" height="30" alt="" class="d-inline-block ms-2 me-2 align-bottom">
                Projekt PHP
            </a>

            <div class="collapse navbar-collapse">
                <ul class="navbar-nav mr-auto">
                    <?php
                    if (isset($_COOKIE['user_id'])) {
                    ?>
                        <ul class="navbar-nav mr-auto ">
                            <li class="nav-item border-end border-start">
                                <a class="nav-link active" aria-current="Main page" href="../Home/Competitions.php">Strona główna</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="Main page" href="../Home/Results.php">Tabela wyników</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="Main page" href="../Registration/Autor.php">Autor</a>
                            </li>
                        </ul>
                    <?php
                    } else { ?>
                        <ul class="navbar-nav ">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="Main page" href="../SignIn/SignIn.php">Logowanie</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="Main page" href="../Registration/Registration.php">Rejestracja</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="Main page" href="../Registration/Autor.php">Autor</a>
                            </li>
                        </ul>
                    <?php } ?>
                </ul>
            </div>
            <?php
            if (isset($_COOKIE['user_id'])) {
            ?>
                <form method="POST" action="" style="margin-right: 20px;">
                    <button type="submit" name="wyloguj" class="btn btn-warning px-4"><i class="fa fa-sign-out me-2" aria-hidden="true"></i>Wyloguj</button>
                </form>
            <?php
            } ?>
        </nav>
    </header>
    <main class="min-vh-100">
<?php
require_once('../../Zawody.Data/Init.php');

if (isset($_COOKIE['user_id'])) {
    header('Location: ../Home/Competitions.php');
}

GetHeader('Logowanie', 'bg-secondary');

$isAuth = false;
if (isset($_POST['zaloguj'])) {
    dbConnect();

    $getUserSql = "SELECT * FROM User WHERE email='{$_POST['email']}'";
    $user = fetch_array(query($getUserSql));
    dbClose();

    if ($user) {
        if (password_verify($_POST['password'], $user['password'])) {
            $isAuth = true;
            $user_id = $user['userId'];
            $is_admin = $user['admin'];
            setcookie('user_id', $user_id, time() + 60 * 100, '/');
            setcookie('is_admin', $is_admin, time() + 60 * 100, '/');
            header('Location: ../Home/Competitions.php');
            session_unset();
        }
    }
}
GetSignInForm($isAuth);

GetFooter();

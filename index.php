<?php
require_once('Zawody.Data/Database.php');

dbConnect();

if (isset($_COOKIE['user_id'])) {
    header('Location: Zawody.Pages/Home/Competitions.php');
    exit();
}

header('Location: Zawody.Pages/SignIn/SignIn.php');

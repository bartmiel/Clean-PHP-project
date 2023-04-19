<?php
require_once('../../Zawody.Data/Init.php');
if (!isset($_COOKIE['user_id'])) {
    header('Location: ../SignIn/SignIn.php');
}
GetHeader('Szczegóły zawodów', 'bg-info d-flex flex-column min-vh-100');

dbConnect();

$competitionId = $_GET['competitionId'];
$sql = "select location, name, date, description from competition where competitionId=$competitionId";
$result = query($sql);
$competition = fetch_assoc($result);

$limit = GetLimit($competitionId);

$sql = "select distanceId, name from distance where competitionId=$competitionId";
$result1 = query($sql);
$distances = [];
foreach ($result1 as $row) {
    array_push($distances, $row);
}

if (isset($_POST["zamknijRejestracje"])) {
    closeRegistration($competitionId);
}
if (isset($_POST["otworzRejestracje"])) {
    openRegistration($competitionId);
}

if (isset($_POST['distanceSelect']) && is_numeric($_POST['distanceSelect'])) {
    $distanceSelected = $_POST['distanceSelect'];
    RegisterToCompetition($distanceSelected);
}

GetCompetitionDetailsView($competition['location'], $competition['name'], $competition['date'], $competition['description'], $limit, $distances, $competitionId);

dbClose();
GetFooter();

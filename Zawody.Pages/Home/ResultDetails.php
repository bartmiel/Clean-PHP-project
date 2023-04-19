<?php
require_once('../../Zawody.Data/Init.php');

if (!isset($_COOKIE['user_id'])) {
    header('Location: ../SignIn/SignIn.php');
}

GetHeader('Wyniki', 'bg-info d-flex flex-column min-vh-100');

dbConnect();
$competitionId = $_GET['competitionId'];
$sql = "select location, name, date from competition where competitionId=$competitionId";
$result = query($sql);
$competition = fetch_assoc($result);

$sql = "select distanceId, name from distance where competitionId=$competitionId";
$result1 = query($sql);
$distances = [];
foreach ($result1 as $row) {
    array_push($distances, $row);
}

if (isset($_POST['distanceSelect']) && is_numeric($_POST['distanceSelect'])) {
    $distanceSelected = $_POST['distanceSelect'];
    foreach ($distances as $d) {
        if ($distanceSelected == $d['distanceId'])
            $distanceSelectedName = $d['name'];
    }
} else {
    $distanceSelected = $distances[0]['distanceId'];
    $distanceSelectedName = $distances[0]['name'];
}

GetResultDetailsView($competition['location'], $competition['name'], $competition['date'], $distances, $competitionId, $distanceSelected, $distanceSelectedName);

dbClose();
GetFooter();

<?php

require_once('../../Zawody.Data/Init.php');

if (!isset($_COOKIE['user_id'])) {
    header('Location: ../SignIn/SignIn.php');
}


GetHeader('Strona Główna', 'bg-secondary d-flex flex-column min-vh-100');
dbConnect();
$sql = 'select competitionId, name, location, date, time, finished, registration, isactive from competition';
$result = query($sql);

if (isset($_POST["zakoncz"])) {
    $competitionId = $_POST['competitionId'];
    endTheEvent($competitionId);
    header('Location: Competitions.php?end=1');
}

if (isset($_POST["usun"])) {
    $competitionId = $_POST['usunCompetitionId'];
    deleteEvent($competitionId);
    header('Location: Competitions.php?del=1');
}

?>
<div class="container justify-content-center mt-4">
    <div class="shadow-box mb-4 p-4" style="border-radius: 15px;">
        <div class="row">
            <?php
            if ($_COOKIE['is_admin']) {
            ?>
                <div class="col-2">
                    <button class="btn btn-lg btn-outline-light" onclick="location.href='AddCompetition.php'">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Nowe zawody</button>
                </div>
            <?php } ?>
            <div class="col">
                <input type="text" id="searchInput" placeholder="Znajdź zawody..." class="form-control form-control-lg w-100">
            </div>
        </div>
    </div>
    <?php

    foreach ($result as $competition) {
        if ($competition['finished'] == 0 && $competition['isactive'] == 1)
            GetCompetitionView($competition['competitionId'], $competition['date'], $competition['name'], $competition['time'], $competition['location'], $competition['registration']);
    }
    GetFooter();
    ?>
</div>
<?php
require_once('../../Zawody.Data/Init.php');

if (!isset($_COOKIE['user_id'])) {
    header('Location: ../SignIn/SignIn.php');
}

GetHeader('Wyniki', 'bg-info d-flex flex-column min-vh-100');
dbConnect();
$sql = 'select competitionId, name, location, date, finished from competition';
$result = query($sql);
?>

<div class="container justify-content-center mt-4">
    <div class="shadow-box mb-4 p-4" style="border-radius: 15px;">
        <div class="row">
            <div class="col">
                <input type="text" id="searchInput" placeholder="Znajdź zawody..." class="form-control form-control-lg w-100">
            </div>
        </div>
    </div>

    <?php
    foreach ($result as $competition) {
        if ($competition['finished'] == 1)
            GetResultsView($competition['competitionId'], $competition['date'], $competition['name'], $competition['location']);
    }

    GetFooter();
    ?>
</div>
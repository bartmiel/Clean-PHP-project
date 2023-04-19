<?php
if (isset($_GET['ok'])) {
?>
    <div class='card col-6 p-4 mt-5 ' style="border-radius:15px;">
        <div class='row'>
            <h4 class='text-center'>Zgłoszenie dodania zawodów zostało utworzone!
        </div>
        <div class='row justify-content-center mt-3'>
            <div class="col-lg-5 text-center">
                <input type='button' onclick="location.href='Competitions.php'" class='btn btn-primary' value='Wróć do strony głównej' />
            </div>
        </div>
    </div>
<?php
} else if ($_COOKIE['is_admin'] == 1) {
?>
    <div class="row justify-content-center">
        <form onsubmit="return validateCompetitionForm();" method="POST" name="form" class="card bg-light shadow col-6 p-4 mt-5" style="border-radius:15px;">
            <div class="mb-3 row">
                <div class="col-12">
                    <label for="competitionName" class="form-label">Nazwa zawodów:</label>
                    <input type="text" name="competitionName" id="inputCompetitionName" class="form-control">
                    <div id="competitionNameFeedback" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-xl-6">
                    <label for="competitionLocation" class="form-label">Miejscowość:</label>
                    <input type="text" name="competitionLocation" id="inputCompetitionLocation" class="form-control">
                    <div id="competitionLocationFeedback" class="invalid-feedback"></div>
                </div>
                <div class="col-xl-3">
                    <label for="competitionDate" class="form-label">Data:</label>
                    <input type="date" name="competitionDate" id="inputCompetitionDate" class="form-control">
                    <div id="competitionDateFeedback" class="invalid-feedback"></div>
                </div>
                <div class="col-lg-3">
                    <label for="competitionStartHour" class="form-label">Godzina rozpoczęcia:</label>
                    <input type="time" name="competitionStartHour" id="inputCompetitionStartHour" class="form-control">
                    <div id="competitionStartHourFeedback" class="invalid-feedback"></div>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-12">
                    <label for="competitionDescription" class="form-label">Opis zawodów:</label>
                    <textarea name="competitionDescription" id="inputCompetitionDescription" rows="6" class="form-control" maxlength="500"></textarea>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-9" id="distance">
                    <label for="competitionDistance" class="form-label">Dystans:</label>
                    <input type="text" name="competitionDistance[]" id="inputCompetitionDistance" class="form-control">
                </div>
                <div class="col-3" id="limit">
                    <label for="competitionDistanceLimit" class="form-label">Limit:</label>
                    <input type="number" name="competitionDistanceLimit[]" id="inputCompetitionDistanceLimit" class="form-control">
                </div>
                <div>
                    <button type="button" name='competitionAddDistance' onclick="addDistance('distance', 'limit')" class="w-100 btn btn-outline-success mb-2 mt-3"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                </div>
            </div>
            <div class="mb-3 row">
                <div class="col-6">
                    <button type="button" onclick="location.href='Competitions.php'" class="w-100 btn btn-secondary mb-2 mt-3">Powrót do strony głównej</button>
                </div>
                <div class="col-6">
                    <button type="submit" class="w-100 btn btn-primary mb-2 mt-3"> Zatwierdź</button>
                </div>
            </div>
        </form>
    </div>
<?php
}
?>
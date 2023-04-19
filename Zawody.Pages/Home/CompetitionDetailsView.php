<div class="container container-fluid">
    <div class="card shadow bg-light mt-4 p-4" style="border-radius: 15px;">
        <div class="mb-3">
            <h1 class="text-uppercase mx-auto"><?= $name ?></h1>
        </div>
        <div class="row row-cols-auto text-left">
            <div class="col border-end border-secondary">
                <h5 class="text-secondary text-uppercase">Data zawodów:</h5>
                <h4 class="text-uppercase mx-auto"><?= GetDateOfEvent($date) ?></h4>
            </div>
            <div class="col">
                <h5 class="text-secondary text-uppercase">Lokalizacja:</h5>
                <h4 class="text-uppercase mx-auto"><?= $location ?></h4>
            </div>
            <div class="col border-start border-secondary">
                <h5 class="text-secondary text-uppercase">Limit uczestników:</h5>
                <h4 class="text-uppercase mx-auto"><?= $limit ?></h4>
            </div>
        </div>
        <hr>
        <div class="row mt-2">
            <h5 class="text-secondary text-uppercase mx-auto">Opis:</h5>
            <p><?= $description ?></p>
        </div>
        <hr>
        <div class="row mb-1">
            <form method="POST" name="form" class=" col-auto px-2 pb-3">
                <div class="row row-cols-auto">
                    <?php if (isOpenRegistration($competitionId) && !$_COOKIE['is_admin']) { ?>
                        <div class="col">
                            <select class="form-select" name="distanceSelect">
                                <option selected>Wybierz dystans</option>
                                <?= GetDistances($distances) ?>
                            </select>
                        </div>
                        <div class="col">
                            <button type="submit" class="w-100 btn btn-primary">Zapisz się</button>
                        </div>
                    <?php } else if ($_COOKIE['is_admin'] == 1) { ?>
                        <div class="d-flex">
                            <form method="POST">
                                <?php if (isOpenRegistration($competitionId)) { ?>
                                    <input name="zamknijRejestracje" class="collapse" value='<?= $competitionId ?>' />
                                    <button class="btn btn-warning rounded-pill" name="zamknijdRejestracje">
                                        <i class="fa fa-pause me-2" aria-hidden="true"></i> Zamknij rejestrację
                                    </button>
                                <?php } else { ?>

                                    <input name="otworzRejestracje" class="collapse" value='<?= $competitionId ?>' />
                                    <button class="btn btn-info rounded-pill" name="otworzRejestracje">
                                        <i class="fa fa-play me-2" aria-hidden="true"></i> Otwórz rejestrację
                                    </button>
                                <?php } ?>
                            </form>
                            <div class="ms-3">
                                <button type="button" onclick="location.href='Competitions.php'" class="btn btn-secondary text-light rounded-pill">Powrót do strony głównej</button>
                            </div>
                        </div>
                    <?php }
                    if (!$_COOKIE['is_admin'] && !isOpenRegistration($competitionId)) { ?>
                        <div>
                            <h5><span class="badge bg-info">Rejestracja zamknięta!</span></h5>
                        </div>
                    <?php } ?>
                </div>
            </form>
        </div>
        <div class="container border-top">
            <table class="table table-hover">
                <thead>
                    <th scope="col">#</th>
                    <th scope="col">Nazwisko</th>
                    <th scope="col">Imię</th>
                    <th scope="col">Miasto</th>
                    <th scope="col">Klub</th>
                    <th scope="col">Dystans</th>
                </thead>
                <tbody>
                    <?= GetParticipants($competitionId) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<section class="card shadow bg-light mb-4 container-fluid" style="border-radius: 15px;">
    <div class="row py-4 px-3">
        <div class="col-2 border-end">
            <div class="text-center">
                <h2 style="font-size: 60px " class="mb-0 font-weight-bold">
                    <?= GetDay($date) ?></h2>

                <div style="font-size: 18px">
                    <?= GetMonth($date) ?>
                </div>
                <div style="font-size: 18px">
                    <?= DayOfTheWeek($date) ?>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="text-dark" style="font-size: 28px">
                <a href="#" class="text-decoration-none text-dark"><?= $name ?></a>
            </div>
            <div class="text-dark" style="font-size: 14px">
                <i class="far fa-clock"></i>Rozpoczęcie: <?= GetTime($time) ?>
            </div>
            <div class="text-dark" style="font-size: 20px">
                <?= $location ?>
            </div>
            <div class="align-items-center mt-2">
                <span class="badge badge-pill bg-dark text-light px-2"><?= GetRegisteredParticipants($competitionId) ?> / <?= GetLimit($competitionId) ?></span>
            </div>
        </div>
        <?php
        $array = GetRegistrationStatus($regStatus);
        ?>
        <div class="col-2 d-flex flex-row-reverse align-self-center">
            <span class="<?= $array[1]; ?> badge badge-pill text-light w-75 align-middle">
                <small><?= $array[0]; ?></small>
            </span>
        </div>
        <div class="col-2 d-flex flex-row-reverse align-items-center border-end">
            <?php if ($_COOKIE['is_admin']) {
            ?>
                <form method="POST" action="">
                    <input name="usunCompetitionId" class="collapse" value='<?= $competitionId ?>' />
                    <button type="submit" class="btn btn-outline-danger rounded-pill mx-2" name="usun">
                        <i class="fa fa-times"></i>
                    </button>
                    <button class="btn btn-outline-info rounded-pill me-3 mx-2">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                    </button>
                </form>
            <?php } ?>
        </div>
        <div class="col-3 d-flex flex-row-reverse align-items-center px-5">
            <div>
                <button class="btn btn-outline-dark rounded-pill mb-3" onclick="location.href='CompetitionDetails.php?competitionId=<?= $competitionId ?>'">
                    <i class="fa fa-arrow-right me-2" aria-hidden="true"></i>
                    Przejdź do zawodów
                </button>
                <?php if ($_COOKIE['is_admin']) { ?>
                    <form method="POST" action="">
                        <input name="competitionId" class="collapse" value='<?= $competitionId ?>' />
                        <button class="btn btn-outline-dark rounded-pill w-100" name="zakoncz">
                            <i class="fa fa-check me-2" aria-hidden="true"></i> Zakończ wydarzenie
                        </button>
                    </form>
                <?php } ?>
            </div>
        </div>
    </div>
</section>
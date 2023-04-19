<section class="card shadow bg-light border-0 mb-4 container-fluid" style="border-radius: 15px;">
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
        <div class="col-7">
            <div class="text-dark" style="font-size: 28px">
                <a href="#" class="text-decoration-none text-dark"><?= $name ?></a>
            </div>
            <div class="text-dark" style="font-size: 20px">
                <?= $location ?>
            </div>
            <div class="align-items-center mt-2">
                <span class="badge badge-pill bg-dark text-light px-3"><?=GetNumberOfFinishedParticipant($competitionId)?></span>
            </div>
        </div>
        <div class="col-3 d-flex flex-row-reverse align-items-center pe-5">
            <button class="btn btn-outline-dark rounded-pill " onclick="location.href='ResultDetails.php?competitionId=<?= $competitionId ?>'">
                <i class="fa fa-arrow-right" aria-hidden="true"></i>
                Przejdź do tabeli wynikami
            </button>
        </div>
    </div>
</section>
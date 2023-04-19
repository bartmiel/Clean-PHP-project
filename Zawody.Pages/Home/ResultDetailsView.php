<div class="container container-fluid">
    <div class="card shadow bg-light mt-4 p-4" style="border-radius: 15px;">
        <div class="mb-3">
            <h1 class="text-uppercase mx-auto">
                <?= $name ?> </h1>
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
        </div>
        <hr>
        <div class="row mt-2">
            <form method="POST" name="form" class="row col-auto px-2 pb-3">
                <div class="col-5">
                    <select class="form-select" name="distanceSelect" onchange='this.form.submit()'>
                        <option selected disabled><?= $distanceSelectedName ?></option>
                        <?= GetDistances($distances) ?>
                    </select>
                </div>
                <div class="col-5">
                    <input type="text" id="searchInput" placeholder="Znajdź zawodnika..." class="form-control ">
                </div>
            </form>
        </div>
        <div class="row">
            <table class="table table-hover">
                <thead>
                    <th scope="col">#</th>
                    <th scope="col">Nazwisko</th>
                    <th scope="col">Imię</th>
                    <th scope="col">Miasto</th>
                    <th scope="col">Klub</th>
                    <th scope="col">Wynik</th>
                </thead>
                <tbody>
                    <?= GetFinishedParticipants($competitionId, $distanceSelected) ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
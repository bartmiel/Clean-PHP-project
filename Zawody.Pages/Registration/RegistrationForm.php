<?php
if (isset($_GET['rej'])) {
?>
    <div class='card col-5 p-4 mt-4' style="border-radius: 15px;">
        <div class='row justify-content-center'>
            <h4 class='text-center mb-4'>Konto zostało utworzone, teraz możesz się zalogować!</h4>
            <input type='button' onclick="location.href='../SignIn/SignIn.php'" class='w-50 btn btn-secondary mb-3' value='Powrót do logowania' />
        </div>
    </div>
<?php
} else {
?>
    <form name="form" onsubmit="return validateForm()" method="POST" action="" class="card bg-light shadow col-4 p-5 pb-4 mt-5" style="border-radius: 15px;">
        <div class="mb-3 row">
            <div class="col-6"><label for="firstName" class="form-label">Imię</label>
                <input type="text" name='firstname' class="form-control" id="inputFirstName">
                <div id="firstNameFeedback" class="invalid-feedback"></div>
            </div>
            <div class="col-6"><label for="lastName" class="form-label">Nazwisko</label>
                <input type="text" name='lastname' class="form-control" id="inputLastName">
                <div id="lastNameFeedback" class="invalid-feedback"></div>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="adres" class="form-label">Adres</label>
            <div class="mb-3">
                <input type="text" name='street' class="form-control" placeholder="Ulica , nr. domu / lokalu" id="inputStreet">
                <div id="streetFeedback" class="invalid-feedback"></div>
            </div>
            <div class="col-7">
                <input type="text" name='city' class="form-control" placeholder="Miasto" id="inputCity">
                <div id="cityFeedback" class="invalid-feedback"></div>
            </div>
            <div class="col">
                <input type="text" name='postalCode' class="form-control" placeholder="Kod pocztowy" id="inputPostal">
                <div id="postalFeedback" class="invalid-feedback"></div>
            </div>
        </div>
        <div class="mb-1" id="clubData">
            <label for="clubName" class="form-label">Nazwa klubu</label>
            <input type="text" name="clubname" class="form-control" id="inputClubName">
        </div>
        <hr />
        <div class="mb-3">
            <label for="email" class="form-label">Adres E-Mail</label>
            <input type="email" name="email" class="form-control" id="inputEmail">
            <div id="emailFeedback" class="invalid-feedback"></div>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Hasło</label>
            <input type="password" name="password" class="form-control" id="inputPassword">
            <div id="password" class="invalid-feedback"></div>
        </div>
        <div class="mb-3">
            <label for="confirmPassword" class="form-label">Potwierdź hasło</label>
            <input type="password" name="confirmPassword" class="form-control" id="inputConfirmPassword">
            <div id="confirmPasswordFeedback" class="invalid-feedback"></div>
        </div>
        <div class="form-checki mt-3">
            <input type="checkbox" class="form-check-input me-3" required>
            <label class="form-check-labell" for="customControlValidation1">Akceptuję regulamin</label>
        </div>
        <hr />
        <div class="row">
            <div class="col-6"><input type="button" onclick="location.href='../SignIn/SignIn.php'" class="w-100 btn btn-secondary mb-3" value="Powrót do logowania" /></div>
            <div class="col-6"><input type="submit" name='zarejestruj' class="w-100 btn btn-primary mb-3" value="Zarejestruj" /></div>
        </div>
    </form>
    <!-- koniec elsa  -->
<?php } ?>
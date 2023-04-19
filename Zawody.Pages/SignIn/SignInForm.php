<div class="containter-fluid" style="margin-top: 50px;">
    <div class="row justify-content-center">
        <form method="POST" action="" class="card bg-light w-25 shadow col-md-auto p-5 mt-5" style="border-radius: 15px;">
            <!-- Autentykacja niepoprawna -->
            <?php if (isset($_POST['zaloguj'])) {
                if (!$isAuth) {
                    echo "<p class='text-danger text-center'>Wprowadzono niepoprawne dane do logowania.</p>";
                }
            } ?>
            <!-- Autentykacja niepoprawna -->
            <div class="mb-3">
                <label for="email" class="form-label">Adres E-Mail</label>
                <input type="email" name="email" class="form-control" id="inputEmail">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Hasło</label>
                <input type="password" name="password" class="form-control" id="inputPassword">
            </div>
            <div class="mb-3">
                <a href="../Registration/Registration.php" class="form-check-label">Załóż nowe konto</a>
            </div>
            <button type="submit" name="zaloguj" class="btn btn-primary">Zaloguj</button>
        </form>
    </div>
</div>
<?php

if (isset($_COOKIE['user_id'])) {
    header('Location: ../Home/Competitions.php');
}

require_once('../../Zawody.Data/Init.php');
GetHeader('Rejestracja', 'bg-secondary');

?>
<div class="containter">
    <div class="row justify-content-center">

        <?php
        createUser($_POST);
        GetRegistrationForm();
        ?>
    </div>
</div>
<script src="Registration.js">
</script>
<?php GetFooter(); ?>
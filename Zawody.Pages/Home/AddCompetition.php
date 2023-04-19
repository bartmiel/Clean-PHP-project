<?php
require_once('../../Zawody.Data/Init.php');
if (!isset($_COOKIE['user_id'])) {
    header('Location: ../SignIn/SignIn.php');
}

GetHeader('Dodaj zawody', 'bg-info d-flex flex-column min-vh-100');
?>
<div class="containter">
    <div class="row justify-content-center">
        <?php
        createCompetition($_POST);
        print_r($_POST);
        GetAddCompetitionFormView();
        ?>
    </div>
</div>
<script src="AddCompetition.js">
</script>
<?php
GetFooter();
?>
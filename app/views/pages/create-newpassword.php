<?php require APPROOT.'/views/inc/header.php'; ?>
<?php
if(isset($_SESSION['errors'])){
    $error = $_SESSION['errors'];
}
?>
<div class="d-flex justify-content-center container-connexion">
    <form class="form-signin text-center col-lg-4" action="<?= URLROOT; ?>/users/confirmResetPassword" method="POST" autocomplete="off">
    <h1>Réinitialisation du mot de passe</h1>
        <div class="form-group">
            <input type="password" class="form-control <?= (!empty($error['password'])) ? 'is-invalid' : ''; ?>" 
            name="password" placeholder="Mot de passe" required>
            <span class="invalid-feedback">
                <?= (!empty($error['password'])) ? $error['password'] : ''?>
            </span>
        </div>
        <div class="form-group">
            <input type="password" class="form-control <?= (!empty($error['password_repeat'])) ? 'is-invalid' : ''; ?>"
             name="password_repeat" placeholder="Répété mot de passe" required>
             <span class="invalid-feedback">
                <?= (!empty($error['password_repeat'])) ? $error['password_repeat'] : ''; ?>
            </span>
        </div>
        <button class="btn btn_2" type="submit">Réinitialise ton mot de passe</button>
    </form>
</div>
<?php require APPROOT.'/views/inc/footer.php'; ?>
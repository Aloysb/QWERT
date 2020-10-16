<?php require APPROOT.'/views/inc/header.php'; ?>
<?php require APPROOT.'/views/inc/navbar_home.php'; ?>

<?php
if(isset($_SESSION['errors'])){
    $error = $_SESSION['errors'];
    
}
?>

<div id = "renew" class="container">
    <div class="row">
        <div class="col-xs-12 col-md-8 offset-md-2">
    <div class="card">
        <div class="card-body">
            <div class="card-title">
            <h1>Mot de passe oublié?</h1>
            </div>
            <p class="card-text">Vous avez perdu votre adresse email ou celle-ci ne fonctionne plus ,
                entrez votre adresse email pour vous envoyer un lien de récupération</p>
            </p>
            <form method="POST" action="<?= '/users/renewPassword'; ?>">
                <div class="form-group">
                    <input type="email" class="form-control  <?= (!empty($error['email'])) ? 'is-invalid' : ''; ?>" name="mail" placeholder="Email">
                    <span class="invalid-feedback">
                        <?= (!empty($error['email'])) ? $error['email'] : ''?>
                    </span>
                </div>
                <div class="form-group text-center">
                    <input  class="btn btn_2" type="submit" value="Envoyer">
                </div> 
                <input type="hidden" name="recaptcha_response_renew" id="recaptchaResponseRenew" >               
            </form>
        </div>
    </div>
</div>
    </div>
</div>
<?php require APPROOT.'/views/inc/footer.php'; ?>

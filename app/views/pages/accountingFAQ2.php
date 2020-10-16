<?php require APPROOT.'/views/inc/header.php'; ?>
<?php 
if (isset($data['data_accounting'])){
    $data = $data['data_accounting'];
}
?>
<!--::header part start::-->
<header id="navbar__compta" class="head" role="banner">
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="/index.html">
            <img src="/assets/images_proto/logo.jpeg" alt="Logo" class="logo-img" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarHome" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg></button>
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarHome">
            <div class="navbar-nav">
                <ul class="menu">
                    <li class="login-btn btn">
                        <a href='/pages/connexion'>
                            <button class="btn">
                                <?php if(isLoggedIn()){ 
                                echo'Retour aux fiches';
                            } else {
                                echo 'Se connecter';
                            };
                            ?></button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
    <section id="plans" class="plans" style="min-height: 75vh; padding-top: 10%">
                   <img src="/assets/images_proto/logo.jpeg" alt="Logo" style="width: 30vw" />
        <h1 class="display-3">Prochainement,</h1>
        <h2 class="lead">Toute l'équipe Doctofiche se mobilise pour vous apporter les meilleurs outils!</h2>
        <h2 class="lead">A très bientôt,</h2>
        <h2 class="quote">L'équipe Doctofiche</h2>
      <img src="../blops/Doctofiche Blobs_Grey blob behind docteur.png" alt="" class="blop_one">
      <img src="../blops/Doctofiche Blobs_Leftside blue blob.png" alt="" class="blop_two">
      <img src="../blops/Doctofiche Blobs_Right side blue blob.png" alt="" class="blop_three">
    </section>

<script>
    const hello = () =>{
        console.log('hello');
    }
</script>
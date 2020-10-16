<?php $listSites = $data['list_sites'];?>
<?php require APPROOT.'/views/inc/header.php'; ?>
<?php $userId = $data['userId'];?>

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

<main id="list-sites">
<div id="list_sites_container" class="content d-flex justify-content-center">
    <div class="blop blop__one">
        <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" width="100%" id="blobSvg">
            <path id="blob" d="M335.5,348Q250,446,140.5,348Q31,250,140.5,142.5Q250,35,335.5,142.5Q421,250,335.5,348Z" fill="#0095d9"></path>
        </svg>
    </div>
    <div class="blop blop__two">
        <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg" width="100%" id="blobSvg">
            <path id="blob" d="M317.5,328.5Q159,407,156.5,245.5Q154,84,315,167Q476,250,317.5,328.5Z" fill="#0095d9"></path>
        </svg>
    </div>
  <div class="container">
  <h1>Gestion des sites</h1>
  <h4>Editer directement le tableau ci-dessous, les changements seront sauvegardés automatiquement.</h4>
    <table id="datatable-list-user">
        <thead>
            <tr>
                <td>Nom</td>
                <td>Adresse</td>
                <td>Description</td>
                <td>Actions</td>
            </tr>
        </thead>
        <tbody>
<tr id =<?= $site['id']; ?> >
  <td id="addName"><input placeholder="Doctofiche" type="text"></td>
  <td id="addHref"><input placeholder = "www.doctofiche.fr" type="text"></td>
  <td id="addDescription"><input placeholder = "La plateforme de référence pour les internes en médecine!" type="text"></td>
  <td >
    <button class='btn btn-primary' onClick = "addSite(<?=$userId?>)">Ajouter</button>
  </td>
</tr>
<?php foreach($listSites as $site): ?>
<tr id =<?= $site['id']; ?> >
  <td contenteditable="true" id="name"><?= $site['name']; ?></td>
  <td contenteditable="true" id="href"><?= $site['href']; ?></td>
  <td contenteditable="true" id="description"><?= $site['description']; ?></td>
  <td >
    <button class='btn btn-danger' onClick = "deleteSite(<?=$site['id'];?>, '<?=$site['name'];?>',<?=$userId?>)">Supprimer</button>
  </td>
</tr>
<?php endforeach; ?>

</tbody>
</table>
</div>
</div>
</main>

 <script>


  //Delete site after confirmation
  const deleteSite = (id,name, userId) => {
    let confirmed = confirm(`Delete ${name}`);
    if (confirmed){
      $.ajax({
            url:`ajaxDeleteSitesList`,
            method: "POST",
            data: {id: id, userId: userId},
          }).done(function( data ) {
            console.log(data)
              location.reload();
          })
    }
  }

  // Add a site to the list and reload
    const addSite = (userId) => {
      let name = document.getElementById('addName').querySelector('input').value;
      let href = document.getElementById('addHref').querySelector('input').value;
      let description = document.getElementById('addDescription').querySelector('input').value;
      if (!name || !href || !description){
        let array = []
        if (!name) {
         array.push('Nom');
        }
        if (!description) {
         array.push('Description');
        }
        if (!href) {
         array.push('Adresse');
        }
        alert(`Merci de bien vouloir remplir le${(array.length > 1)?'s':''} champ${(array.length > 1)?'s':''} ${array.join(', ')} avant d'ajouter le site.`);
      } else {
        $.ajax({
              url:`ajaxAddSitesList`,
              method: "POST",
              data: {name: name, href: href, description: description, userId: userId},
            }).done(function( data ) {
                console.log(data);
                location.reload();
            })
      }
    }
  

    // When editing a contenteditable and losing focus, save to DB.
$(function(){

    $("td[contenteditable=true]").blur(function(){
        var id = $(this).parent().attr("id") ;
        var name = $(this).attr("id") ;
        var value = $(this).text() ;
        let userId = <?=$userId?>;

        $.ajax({
            url:`ajaxUpdateSitesList`,
            method: "POST",
            data: {id: id, name: name, value: value, userId: userId},
          }).done(function( data ) {
            console.log(data)
            location.reload();
          })
    });
});
</script>

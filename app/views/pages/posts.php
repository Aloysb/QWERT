<?php require APPROOT.'/views/inc/header.php'; ?>
<?php $user=$_SESSION['data_user']; ?>
<?php $posts = $data['posts'];?>
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

</div>
</div>
</div>
<main id="posts-main">
  <div id="posts" class="content d-flex justify-content-center">
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
    <div class="container container-accounting text-center">
      <div class="card">
        <div class="row">
          <div class="col-md-12">
            <div class="row">
              <div class="col-6 col-md-6 d-flex justify-content-between flex-wrap align-items-center pb-4">
                <div class="title py-3">
                  <h1>Articles</h1>
                </div>
              </div>
              <div class="col-6 col-md-6 d-flex justify-content-between flex-wrap align-items-center pb-4">
                <input placeholder="Recherche rapide" type="text" id="posts__search">
              </div>
            </div>
            <table class="post-table">
    <!--             <thead>
                    <tr>
                        <td class="tri_titre">Titre</td>
                        <td class="tri_date">Date</td>
                    </tr>
            </thead> -->
              <tbody>
                <tr>
                    <td>
                <?php if($user->{'role'} === 'ROLE_ADMIN'): ?>
<a class="button btn btn-primary shadow" href="/pages/addPost">Ajouter un article</a>
<?php endif; ?>
</td>
</tr>
                <?php 
                    foreach($posts as $post):
                ?>
                <tr>
                    <td>
                  <a href="<?= '/pages/article/'.$post['id']; ?>" class="post">
                      <?php if ($post['status'] == 0): ?>
                      <span class="badge badge-pill badge-danger">non lue</span>
                      <?php else: ?>
                      <span class="badge badge-pill badge-success">lue</span>
                      <?php endif; ?>
                      <p class="post__title">
                        <?php if($post['notif'] == 1):?>
                          <span class="notif"></span>
                        <?php endif ;?>
                        <?php 
                        $line=$post['title'];
                        if (preg_match('/^.{1,100}\b/s', $post['title'], $match))
                        {
                            $line=$match[0];
                            if($line != $post['title']){
                                $line = $line.'...';
                            }
                        }
                        echo ($line); 
                        ?>
                      </p>
                      <p class='post__date'>
                        <?php
                            $date = date_create($post['date']);
                            setlocale(LC_TIME, "fr_FR","French");
                            // dd($date);
                            $date = date_format($date, 'd/m/Y');
                            // $date = ucwords(utf8_encode(strftime("%A %d %B %G", strtotime($date))));
                            echo $date;
                        ?>
                      </p>
                                    <!-- <?php if($user->{'role'} === 'ROLE_ADMIN'): ?>
                                                    <a  href="<?='/pages/article-modification/'.$post['id']; ?>"  class="btn-article edit-btn" >Modifier</a>
                                                <?php endif; ?> -->
                  </td>

                  </a>
              </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
</main>
<script>
function slugify(str) {

    function decodeHtml(html) {
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
    }


    var map = {
      '-': ' ',
      '-': '_',
      'a': 'á|à|ã|â|À|Á|Ã|Â',
      'e': 'é|è|ê|É|È|Ê',
      'i': 'í|ì|î|Í|Ì|Î',
      'o': 'ó|ò|ô|õ|Ó|Ò|Ô|Õ',
      'u': 'ú|ù|û|ü|Ú|Ù|Û|Ü',
      'c': 'ç|Ç',
      'n': 'ñ|Ñ'
    };

    str = str.toLowerCase()
    str= decodeHtml(str)

    for (var pattern in map) {
      str = str.replace(new RegExp(map[pattern], 'g'), pattern);
    };

    return str;
  };

//Add hidden class to folder not matching research.
const displaySearchResults = (files) => {
  let posts = [...document.querySelectorAll('.post')];
  posts.filter(post => !files.includes(post.href.match(/\d+/g)[0])).map(post => post.classList.add('hidden'))
}

// Remove hidden to all folders.
const displayAllArticles = () => {
  let posts = document.querySelectorAll('.post')
  posts.forEach(el => el.classList.remove('hidden'));
}

let files = <?php echo($data['posts__search']) ?>;

let search = document.getElementById('posts__search')

//Search event
search.addEventListener('keyup', (e) => {
  let searchValue = slugify(search.value);
   sessionStorage.setItem('searchValue', null);
  displayAllArticles();
  if (e.keyCode == 13) {
    search.value = '';
    return
  } else {
    let filteredFiles = files.filter(file => (slugify(file.content).includes(searchValue) || slugify(file.title).includes(searchValue))).map(file => file.id);
    if (search.value != "") displaySearchResults(filteredFiles);
    if (search.value != "") sessionStorage.setItem('searchValue', searchValue);
  }
});

</script>

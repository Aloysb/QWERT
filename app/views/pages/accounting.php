<?php require APPROOT . '/views/inc/header.php'; ?>
<?php
if (isset($data['data_accounting'])) {
  $user = $data['user'];
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
                <?php if (isLoggedIn()) {
                  echo 'Retour aux fiches';
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
<!-- Content start -->
<main id="compta-main">
  <div id="comptabilite" class="content d-flex justify-content-center">
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
          <div class="col-6 col-offset-3 print ">
            <img class="print " src="/assets/images_proto/logo.jpeg" alt="Logo" class="logo-img" style="width: 50%" />
          </div>
          <div class="col-md-12">
            <div class="row">
              <div class="col-12 d-flex justify-content-between flex-wrap align-items-center pb-4">
                <div class="title py-3">
                  <h1>Comptabilité</h1>
                </div>
                <div class="print">
                  <h2><?= $user->{'name'} ?> <?= $user->{'firstname'} ?></h2>
                </div>
                <div class='actions d-flex flex-wrap justify-content-center'>
                  <div class='mr-2 my-2 btn btn-outline-primary d-flex justify-content-center align-items-center' id="toggle-ajouter-compta">

                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle">
                      <circle cx="12" cy="12" r="10"></circle>
                      <line x1="12" y1="8" x2="12" y2="16"></line>
                      <line x1="8" y1="12" x2="16" y2="12"></line>
                    </svg>
                    Ajouter</div>
                  <a href="/pages/faq-comptabilite" class='mr-2 my-2 btn btn-outline-success'>
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-help-circle">
                      <circle cx="12" cy="12" r="10"></circle>
                      <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                      <line x1="12" y1="17" x2="12.01" y2="17"></line>
                    </svg>Aide administrative</a>
                  <div class='mr-2 my-2 btn btn-outline-primary' id="print-compta" onClick="print()"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-printer">
                      <polyline points="6 9 6 2 18 2 18 9"></polyline>
                      <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                      <rect x="6" y="14" width="12" height="8"></rect>
                    </svg>Imprimer</div>
                </div>
              </div>
            </div>
            <div class='row py-2'>
              <div class="col-12 col-md-6 d-flex flex-wrap justify-content-start pb-4 dates__input">
                <div class="mx-2">
                  <label for="start_date">Du : </label>
                  <input class="date-input" id="start_date" type="date" value='2020-01-01' required>
                </div>
                <div class="mx-2 ml-4--md">
                  <label for="end_date">Au : </label>
                  <input class="date-input" id="end_date" type="date" value='2020-12-31' required>
                </div>
                <div class="col col-12 d-flex justify-content-start  mt-2">
                  <label for="end_date">Ou sélectionnez la période: </label>
                  <select onchange="changePeriod(this)" class="p-2">
                    <option selected value="null">Période</option>
                    <option value="d">Aujourd'hui</option>
                    <option value="w">Cette semaine</option>
                    <option value="m">Ce mois</option>
                    <option value="y">Cette année</option>
                  </select>
                </div>
              </div>
              <div class="col-12 col-md-6 d-flex justify-content-end flex-wrap totaux">
                <h4 class="total d-flex justify-content-end">Total de la période: <span id="totalDay"></span><small>€</small></h4>
                <h4 class="total d-flex justify-content-end">Total de la rétrocession: <span id="totalRetrocession"></span><small>€</small></h4>
              </div>
            </div>
            <table id="table-compta" class="table table-stripped">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Docteur remplacé</th>
                  <th>Total de la journée</th>
                  <th>Rétrocession</th>
                  <th>Totale de la rétrocession</th>
                  <th>Commentaires</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <form class='hidden' action="/users/AddAccounting" method="POST">
                  <div>
                    <tr id="inputform" class="hideclass hidden" style="background-color: #f9f9f9">
                      <td><input autocomplete="off" type="date" value="<?= date('Y-m-d'); ?>" name="dateAccounting" class="form-control" required></td>
                      <td><input autocomplete="on" type="text" name="drReplace" class="form-control" required></td>
                      <td><input autocomplete="off" type="text" name="totalOfDay" onkeyup="f()" class="form-control" id="totalofday" required></td>
                      <td>
                        <select name="retro" class="form-control" onchange="f()" id="Retro">
                          <option value="100">100%</option>
                          <option value="95">95%</option>
                          <option value="90">90%</option>
                          <option value="85">85%</option>
                          <option value="80">80%</option>
                          <option value="75">75%</option>
                          <option value="70">70%</option>
                          <option value="65">65%</option>
                          <option value="60">60%</option>
                          <option value="55">55%</option>
                          <option value="50">50%</option>
                        </select>
                      </td>
                      <td><input autocomplete="off" type="number" readonly name="tRetro" id="TRetro" name="" class="form-control"></td>
                      <td><input autocomplete="off" type="text" name="cmt" class="form-control"></td>
                      <td class='validate-input'>
                        <button class='submit pt-1' type='submit'>
                          <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="30" height="30" viewBox="0 0 512 512">
                            <defs>
                              <clipPath id="clip-Icon_-_Check">
                                <rect width="512" height="512" />
                              </clipPath>
                            </defs>
                            <g id="Icon_-_Check" data-name="Icon - Check" clip-path="url(#clip-Icon_-_Check)">
                              <g id="shapes-and-symbols" transform="translate(0.494 0.776)">
                                <path id="Path_365" data-name="Path 365" d="M255.612,0C114.662,0,0,114.662,0,255.612S114.662,511.224,255.612,511.224,511.224,396.562,511.224,255.612,396.562,0,255.612,0Zm0,0" fill="#52ca9c" />
                                <path id="Path_366" data-name="Path 366" d="M385.38,201.695,246.921,340.149a21.281,21.281,0,0,1-30.118,0l-69.227-69.227A21.3,21.3,0,0,1,177.7,240.8l54.167,54.168,123.4-123.395a21.3,21.3,0,0,1,30.119,30.119Zm0,0" transform="translate(-0.214 -0.251)" fill="#fafafa" />
                              </g>
                            </g>
                          </svg></button>
                      </td>
                    </tr>
                  </div>
                </form>
                <?php if (isset($data)) : ?>
                  <?php foreach ($data as $row) : ?>
                    <tr class='data-row hidden'>
                      <td class='rowId' hidden><?= $row->{'id'}; ?></td>
                      <td class="rdate">
                        <?php echo date("d-m-y", strtotime($row->{'dateAccounting'})) ?>
                      </td>
                      <td class="dr" id="<?php echo $row->{'id'}; ?>">
                        <?php echo $row->{'drReplace'}; ?>
                      </td>
                      <td class="totd">
                        <?php echo $row->{'totalOfDay'}; ?>
                      </td>
                      <td class="ret" val="<?php echo (int)$row->{'retro'}; ?>">
                        <?php echo (int)$row->{'retro'};  ?>%</td>
                      <td class="tret">
                        <?php echo $row->{'tRetro'}; ?>
                      </td>
                      <td class="cmt1">
                        <?php echo $row->{'comment'}; ?>
                      </td>
                      <td>
                        <form action="/users/deleteRowAccounting" method="POST">
                          <div style="min-width: 80px" class=''>
                            <button type="submit" value="<?php echo $row->{'id'}; ?>" name="delete" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                            <button data-toggle="modal" type="button" onclick="updater(this)" data-target="#updatRecipt" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></button>
                          </div>
                        </form>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- modal -->
      <div class="modal fade" id="updatRecipt" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" style="min-width: 80%">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Mise à jour</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px">
              <div class="panel panel-default">
                <form action="/users/updateRowAccounting" method="POST">
                  <div class="panel-body" style="padding: 20px">
                    <div class="row">
                      <table class="table table-stripped">
                        <thead>
                          <tr>
                            <th>Date</th>
                            <th>Docteur remplacé</th>
                            <th>Total de la journée</th>
                            <th>rétrocession</th>
                            <th>Totale de la rétrocession</th>
                            <th>Commentaires</th>
                          </tr>
                        </thead>
                        <tbody>
                          <div>
                            <tr id="updateriform">
                              <input name='rowId' id="id" class='hidden' hidden>
                              <td><input autocomplete="off" type="date" id="rudate" name="dateAccounting" class="form-control" required></td>
                              <td><input autocomplete="off" type="text" id="rudr" name="drReplace" class="form-control" required></td>
                              <td><input autocomplete="off" type="text" name="totalOfDay" onkeyup="f1()" required class="form-control" id="totalofday1"></td>
                              <td>
                                <select name="retro" class="form-control" onchange="f1()" id="Retro1">
                                  <option value="100">100%</option>
                                  <option value="95">95%</option>
                                  <option value="90">90%</option>
                                  <option value="85">85%</option>
                                  <option value="80">80%</option>
                                  <option value="75">75%</option>
                                  <option value="70">70%</option>
                                  <option value="65">65%</option>
                                  <option value="60">60%</option>
                                  <option value="55">55%</option>
                                  <option value="50">50%</option>
                                </select>
                              </td>
                              <td><input autocomplete="off" type="number" readonly name="tRetro" id="TRetro1" name="" class="form-control"></td>
                              <td><input autocomplete="off" id="ucmt" type="text" name="cmt" class="form-control"></td>
                            </tr>
                          </div>
                        </tbody>
                      </table>
                    </div>
                    <div class="modal-footer" style="padding-bottom: 0px;">
                      <input type="submit" class="btn btn-primary shadow" value="Mettre à jour" name="updateRowAccounting">
                      <input type="hidden" id="urid" name="id" value="">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>
<!-- end of modal -->
<?php require APPROOT . '/views/inc/footer.php'; ?>
<script type="text/javascript" src='/js/compta.js'></script>
<script type="text/javascript" src='/js/custom1.js'></script>
<?php require APPROOT . '/views/inc/print.php'; ?>
<script>
  document.getElementById('print-compta').addEventListener('click', () => printCompta());

  const changePeriod = (input) => {
    if (!input.value) return;

    var today = new Date();
    var dd = String(today.getDate()).padStart(2, '0');
    var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
    var yyyy = today.getFullYear();

    today = yyyy + '-' + mm + '-' + dd;

    let startDateInput = document.getElementById('start_date')
    let endDateInput = document.getElementById('end_date')

    switch (input.value) {
      case 'd':
        startDateInput.value = today;
        endDateInput.value = today;
        break;
      case 'w':
        var today = new Date();
        let day = today.getDay();
        // console.log(dd - day + 1 + '/' + mm + '/' + yyyy);
        startDateInput.value = `${yyyy}-${mm}-${dd - day + 1}`;
        endDateInput.value = `${yyyy}-${mm}-${parseInt(dd) + parseInt(day + 2)}`;
        break;
      case 'm':
        var date = new Date();
        var firstDay = new Date(date.getFullYear(), date.getMonth(), 1);
        var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
        startDateInput.value = `${yyyy}-${mm}-${("0" + firstDay.getDate()).slice(-2)}`;
        endDateInput.value = `${yyyy}-${mm}-${lastDay.getDate()}`;
        break;
      case 'y':
        startDateInput.value = `${yyyy}-01-01`;
        endDateInput.value = `${yyyy}-12-31`;
        break;

    }
    filterByDate();
  }
</script>
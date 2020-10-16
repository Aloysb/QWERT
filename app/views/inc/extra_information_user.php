<?php // Tableau des départements français ! 

$departements = array(); 

$departements['01'] = 'Ain'; 
$departements['02'] = 'Aisne'; 
$departements['03'] = 'Allier'; 
$departements['04'] = 'Alpes de Haute Provence'; 
$departements['05'] = 'Hautes Alpes'; 
$departements['06'] = 'Alpes Maritimes'; 
$departements['07'] = 'Ardèche'; 
$departements['08'] = 'Ardennes'; 
$departements['09'] = 'Ariège'; 
$departements['10'] = 'Aube'; 
$departements['11'] = 'Aude'; 
$departements['12'] = 'Aveyron'; 
$departements['13'] = 'Bouches du Rhône'; 
$departements['14'] = 'Calvados'; 
$departements['15'] = 'Cantal'; 
$departements['16'] = 'Charente'; 
$departements['17'] = 'Charente Maritime'; 
$departements['18'] = 'Cher'; 
$departements['19'] = 'Corrèze'; 
$departements['2A'] = 'Corse du Sud'; 
$departements['2B'] = 'Haute Corse'; 
$departements['21'] = 'Côte d\'Or'; 
$departements['22'] = 'Côtes d\'Armor'; 
$departements['23'] = 'Creuse'; 
$departements['24'] = 'Dordogne'; 
$departements['25'] = 'Doubs';
$departements['26'] = 'Drôme'; 
$departements['27'] = 'Eure'; 
$departements['28'] = 'Eure et Loir'; 
$departements['29'] = 'Finistère'; 
$departements['30'] = 'Gard'; 
$departements['31'] = 'Haute Garonne'; 
$departements['32'] = 'Gers'; 
$departements['33'] = 'Gironde'; 
$departements['34'] = 'Hérault'; 
$departements['35'] = 'Ille et Vilaine'; 
$departements['36'] = 'Indre'; 
$departements['37'] = 'Indre et Loire'; 
$departements['38'] = 'Isère'; 
$departements['39'] = 'Jura'; 
$departements['40'] = 'Landes'; 
$departements['41'] = 'Loir et Cher'; 
$departements['42'] = 'Loire'; 
$departements['43'] = 'Haute Loire'; 
$departements['44'] = 'Loire Atlantique'; 
$departements['45'] = 'Loiret'; 
$departements['46'] = 'Lot'; 
$departements['47'] = 'Lot et Garonne'; 
$departements['48'] = 'Lozère'; 
$departements['49'] = 'Maine et Loire'; 
$departements['50'] = 'Manche'; 
$departements['51'] = 'Marne'; 
$departements['52'] = 'Haute Marne'; 
$departements['53'] = 'Mayenne'; 
$departements['54'] = 'Meurthe et Moselle'; 
$departements['55'] = 'Meuse'; 
$departements['56'] = 'Morbihan'; 
$departements['57'] = 'Moselle'; 
$departements['58'] = 'Nièvre'; 
$departements['59'] = 'Nord'; 
$departements['60'] = 'Oise'; 
$departements['61'] = 'Orne'; 
$departements['62'] = 'Pas de Calais'; 
$departements['63'] = 'Puy de Dôme'; 
$departements['64'] = 'Pyrénées Atlantiques'; 
$departements['65'] = 'Hautes Pyrénées'; 
$departements['66'] = 'Pyrénées Orientales'; 
$departements['67'] = 'Bas Rhin'; 
$departements['68'] = 'Haut Rhin'; 
$departements['69'] = 'Rhône-Alpes'; 
$departements['70'] = 'Haute Saône'; 
$departements['71'] = 'Saône et Loire'; 
$departements['72'] = 'Sarthe'; 
$departements['73'] = 'Savoie'; 
$departements['74'] = 'Haute Savoie'; 
$departements['75'] = 'Paris'; 
$departements['76'] = 'Seine Maritime'; 
$departements['77'] = 'Seine et Marne'; 
$departements['78'] = 'Yvelines'; 
$departements['79'] = 'Deux Sèvres'; 
$departements['80'] = 'Somme'; 
$departements['81'] = 'Tarn'; 
$departements['82'] = 'Tarn et Garonne'; 
$departements['83'] = 'Var'; 
$departements['84'] = 'Vaucluse'; 
$departements['85'] = 'Vendée'; 
$departements['86'] = 'Vienne'; 
$departements['87'] = 'Haute Vienne'; 
$departements['88'] = 'Vosges'; 
$departements['89'] = 'Yonne'; 
$departements['90'] = 'Territoire de Belfort'; 
$departements['91'] = 'Essonne'; 
$departements['92'] = 'Hauts de Seine'; 
$departements['93'] = 'Seine St Denis'; 
$departements['94'] = 'Val de Marne'; 
$departements['95'] = 'Val d\'Oise'; 
$departements['97'] = 'DOM'; 
$departements['971'] = 'Guadeloupe'; 
$departements['972'] = 'Martinique'; 
$departements['973'] = 'Guyane'; 
$departements['974'] = 'Réunion'; 
$departements['975'] = 'Saint Pierre et Miquelon'; 
$departements['976'] = 'Mayotte'; 

?>



<div class="modal fade" id="extraInfoUserModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModalLabel">Information supplémentaires requises</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <section>
            Merci de renseigner les informations suivantes avant de continuer:
        <form method="POST" action="/users/updateuser" autocomplete="off">
            <div class="row">
                        <label for="birth_date" class="col-sm-6 col-form-label <?= (!empty($error['birth_date'])) ? 'is-invalid' : ''; ?> " ">Date de naissance</label>
                 
                <div class="col-sm-6">
                  <input type="date" name="birth_date" class="form-control mt-0 <?= (!empty($error['birth_date'])) ? 'is-invalid' : ''; ?> " " id="birth_date">
                </div>
              </div>
                             <span class="invalid-feedback">
                    <?= isset($error['birth_date']) ? $error['birth_date'] : '' ; ?>
                </span>
                <div class="row mt-3 d-flex justify-content-around">
                      <legend class="col-form-label col-sm-6 pt-0">Sexe</legend>
                      <div class="col-sm-3">
                        <div class="form-check d-flex align-items-center">
                          <input class="form-check-input mt-0 <?= (!empty($error['name'])) ? 'is-invalid' : ''; ?> " " type="radio" name="sex" value="F" id="sexF" checked>
                          <label class="form-check-label <?= (!empty($error['name'])) ? 'is-invalid' : ''; ?> " " for="sexF">
                            Femme
                          </label>
                        </div>
                        </div>
                        <div class="col-sm-3">
                        <div class="form-check d-flex align-items-center">
                          <input class="form-check-input mt-0 <?= (!empty($error['name'])) ? 'is-invalid' : ''; ?> " " type="radio" name="sex" value="H" id='sexeH'>
                          <label class="form-check-label <?= (!empty($error['name'])) ? 'is-invalid' : ''; ?> " " for="sexeH">
                            Homme
                          </label>
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <input class="form-control <?= (!empty($error['ecn_year'])) ? 'is-invalid' : ''; ?> " " type="number" placeholder="Année de passage ECN" name="ecn_year" id="ecn_year"  min="1920" max="2022">
                        <span class="invalid-feedback">
                            <?= (!empty($error['ecn_year'])) ? $error['ecn_year'] : '' ; ?>
                        </span>
                    </div>
                    <div class="col-sm-6">
                        <select class="custom-select <?= (!empty($error['ecn_place'])) ? 'is-invalid' : ''; ?> " " placeholder="Département ECN" name="ecn_place" id="ecn_place">
                            <option selected value="0">Département ECN</option>
                            <?php foreach($departements as $index=>$departement): ?>
                                <option value=<?=$index;?>><?=$index.' - '.$departement; ?></option>
                            <?php endforeach; ?>
                        </select>
                              <span class="invalid-feedback">
                            <?= (!empty($error['ecn_place'])) ? $error['ecn_place'] : '' ; ?>
                        </span>
                    </div>
                </div>
                <div class="row">
                      <div class="col-sm-12">
           <input class="form-control <?= (!empty($error['ecn_school'])) ? 'is-invalid' : ''; ?>" value="<?= isset($data['ecn_school']) ? $data['ecn_school'] : ''; ?>" type="text" name="ecn_school" id="ecn_school" placeholder="Faculté ECN"/>
                <span class="invalid-feedback">
                    <?= (!empty($error['ecn_school'])) ? $error['ecn_school'] : '' ; ?>
                </span>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-sm-12">
                        <select name="status" id="status" class="custom-select <?= (!empty($error['status'])) ? 'is-invalid' : ''; ?> " ">
                      <option selected value='null'>Status</option>
                      <option value="externe">Externe</option>
                      <option value="interne-non-these">Interne non thésé</option>
                      <option value="interne-these">Interne thésé</option>
                      <option value="medecin">Médecin</option>
                    </select>
                    </div>
                                    <span class="invalid-feedback">
                    <?= (!empty($error['status'])) ? $error['status'] : '' ; ?>
                </span>
                </div>
        
        </section>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="submit" class="btn btn-primary">Continuer</a>
        </form>
      </div>
    </div>
  </div>
</div>
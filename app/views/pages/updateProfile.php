<?php require APPROOT.'/views/inc/header.php'; ?>
    <div class="container container-updateProfile">
        <?php
        if (isset($data)){
            $data=reset($data);
        }
        if (isset($_SESSION['errors'])){
            $error = $_SESSION['errors'];
        }       
        ?>
        <div class="row">
                <h4>MON PROFILE/<small>Mise à jour</small> </h4>
                <table class="table table-bordered table-stripped" >
                    <tbody>
                        <tr>
                            <td class="thead"><span class="titlehead">Image du profile</span></td>
                            <td><span class="titlevalue"  id="profileimage" ><img  src="<?='/img/'.$data->{'avatar'}; ?>" alt=""></span>
                                <p > <button type="button" class="btn btn-primary btn-sm "  data-toggle="modal" data-target="#exampleModal" style="margin-top: 10px;margin-left: 50px">Changer d'avatar</button></p>
                            </td>
                        </tr>
                        <tr>
                            <form action="">
                                <td class="thead"> <span class="titlehead">Mot de passe:</span></td>
                                <td>
                                    <button  style="display: inline-block" type="button"  data-toggle="modal"  data-target="#updateModal" name="submit" class="btn btn-danger btn-sm" value="Update">Changer le mot de passe</button></span>
                                </td>
                            </form>
                        </tr>
                        <tr>
                        <form action="<?= URLROOT; ?>/users/updateProfile" method="POST">
                            <td class="thead"><span class="titlehead">Login:</span></td>
                            <td>
                                <span class="titlevalue"><input type="text" name="login" class="form-control <?= (!empty($error['login'])) ? 'is-invalid' : ''; ?> "  style="background-color: #FFFFFF" value="<?= $data->{'login'}; ?>">
                                <span class="invalid-feedback">
                                    <?= isset($error['login']) ? $error['login'] : '' ; ?>
                                </span>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="thead"> <span class="titlehead">Email:</span></td>
                            <td>
                            <span class="titlevalue">
                                <input type="text" name="email" style="background-color: #FFFFFF" class="form-control <?= (!empty($error['email'])) ? 'is-invalid' : ''; ?> " value="<?= $data->{'mail'}; ?>">
                                <span class="invalid-feedback">
                                    <?= (!empty($error['email'])) ? $error['email'] : '' ; ?>
                                </span>
                            </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="thead"> <span class="titlehead"></span></td>
                            <td>
                                <button  style="display: inline-block" type="submit" class="btn btn-danger btn-sm" value="Update">Mettre à jour</button></span>
                                <a href="<?= URLROOT.'/pages/profil'; ?>"  style="display: inline-block" type="submit" class="btn btn-outline-secondary btn-sm">Annuler</a></span>
                            </td>
                        </form>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document" style="max-width: 90%!important;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Télécharge Ton avatar</h5>
                <button type="button" class="close" data-dismiss="modal" onclick="refresh" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <div class="modal-body">

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4 text-center">
                    <div id="upload-demo" style="width:350px"></div>
                </div>
                <div class="col-md-4" style="padding-top:30px;">
                    <strong>Selectionne une image:</strong>
                    <br/>
                    <input type="file" name="image" class="btn btn-primary" id="upload">
                    <br/><br>
                    <br>
                    <button class="btn btn-success upload-result">Modifier image de profile</button>
                </div>
                <div class="col-md-4" style="">
                    <div id="upload-demo-i" style="background:#e1e1e1;width:300px;padding:30px;height:300px;margin-top:30px"></div>
                </div>
            </div>
        </div>
    </div>
    </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" id="closeUpdate" data-dismiss="modal">Close</button>
        </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modification du mot de passe</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="refresh" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding-top: 0px; padding-bottom: 0px">

                    <div class="panel panel-default">
                        <form id="formRenewPassword">
                            <div class="panel-body" style="padding: 20px">
                                <div class="row">
                                    <h6>Ancien mot de passe</h6>
                                    <input type="text" class="form-control" name="oldPassword" id="oldPassword">
                                    <br>
                                    <br>
                                    <h6>Nouveau mot de passe</h6>
                                    <input type="text" class="form-control" name="newPassword" id="newPassword">
                                </div>

                                <div class="modal-footer" style="padding-bottom: 0px;">
                                    <input type="submit" class="btn btn-secondary"  value="Mettre à jour" name="updatePass" >
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require APPROOT.'/views/inc/footer.php'; ?>
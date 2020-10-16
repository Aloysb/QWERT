<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container container-addFile">
    <div class="row">
        <div class="col-lg-12 mt-2">
            <nav class="navbar navbar-dark bg-primary justify-content-center">
                <h1 class="navbar-brand ">AJOUTER UN NOUVEAU FICHIER</h1>
            </nav>
        </div>
    </div>
    <nav class="navbar navbar-light bg-light">
        <a href="<?php echo URLROOT.'/pages/search'; ?>" class="navbar-brand"><i class="fa fa-arrow-left" style="color:blue;"></i></a>
    </nav>
    <form class="editorForm">
        <input type="hidden" name="folderId" value="<?php echo $data['id']; ?>">
        <div class="md-form input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Titre</span>
                </div>
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroupMaterial-sizing-default" name="myTitle" autocomplete="off">
        </div>
        <div class="form-group">
            <textarea class="form-control" id="exampleFormControlTextarea3" name="content"></textarea>
        </div>
    </form>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>

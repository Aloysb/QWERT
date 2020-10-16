<?php require APPROOT . '/views/inc/header.php'; ?>
<?php $file = reset($data['file']);?>
<div class="container container-editFile">
    <div class="row">
        <div class="col-lg-12 mt-2">
            <nav class="navbar navbar-dark bg-primary justify-content-center">
                <h1 class="navbar-brand"><?php echo strtoupper($file->title); ?></h1>
            </nav>
        </div>
    </div>
    <nav class="navbar navbar-light bg-light">
        <a href="<?php echo URLROOT.'/single/index/'.$file->id; ?>" class="navbar-brand" ><i class="fa fa-arrow-left" style="color:blue;"></i></a>
    </nav>

    <form class="mt-2 editorForm" method="post" action="<?php echo URLROOT.'/single/updateFile/'.$file->id;?>" enctype="multipart/form-data">
        <input name="folderId" type="hidden" value="<?php echo $file->medicalFolder_id; ?>">
        <div class="md-form input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text md-addon" id="inputGroupMaterial-sizing-default">Titre</span>
            </div>
            <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroupMaterial-sizing-default" name="myTitle" autocomplete="off" value="<?php echo $file->title; ?>">
        </div>
        <div class="form-group">
            <textarea class="form-control" id="exampleFormControlTextarea3" rows="7" name="myDescription"><?php echo $file->description; ?></textarea>
        </div>
    </form>
</div>
<?php require APPROOT.'/views/inc/footer_area.php'; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>

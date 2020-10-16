<?php require APPROOT . '/views/inc/header.php'; ?>
<?php $file = reset($data['file']);?>
<div class="container container-single">
    <nav class="navbar navbar-dark bg-primary justify-content-center">
        <h1 class="navbar-brand "></i><?php echo strtoupper($file->title); ?></h1>
    </nav>    
    <nav class="navbar navbar-light bg-light">
        <a href="<?php if($_SERVER['HTTP_REFERER'] == URLROOT.'/pages/fiche'){ echo URLROOT.'/pages/fiche'; } elseif($_SERVER['HTTP_REFERER'] == URLROOT.'/pages/exam'){ echo URLROOT.'/pages/exam'; } elseif($_SERVER['HTTP_REFERER'] == URLROOT.'/pages/medicament'){ echo URLROOT.'/pages/medicament'; } else { echo URLROOT.'/pages/fiche'; } ?>" class="navbar-brand" ><i class="fa fa-arrow-left" style="color:blue;"></i></a>
        <?php if($file->{'user_id'} === $_SESSION['data_user']->{'id'}): ?>
        <a <?php if(($_SESSION['data_user']->{'role'} == 'ROLE_SUBSCRIBER') || ($_SESSION['data_user']->{'role'} == 'ROLE_ADMIN')){ echo 'href="'.URLROOT.'/single/edit/'.$file->id.'"'; } else { echo "data-toggle='modal' data-target='#exampleUnsubscribing'";} ?> class="navbar-brand" ><i class="fa fa-edit" style="color:blue;"></i></a>
        <a <?php if(($_SESSION['data_user']->{'role'} == 'ROLE_SUBSCRIBER') || ($_SESSION['data_user']->{'role'} == 'ROLE_ADMIN')){ echo 'href="'.URLROOT.'/single/delete/'.$file->id.'"'; } else { echo 'data-toggle="modal" data-target="#exampleUnsubscribing"';} ?> class="navbar-brand docto-single-delete" ><i class="fa fa-trash" style="color:blue;"></i></a>
        <?php endif; ?>
    </nav>
    <div class="card mb-3 col-md-12">
        <div class="docto-editor-content">
            <?php echo htmlspecialchars_decode($file->{'description'}); ?>
        </div>
    </div>
</div>
<?php require APPROOT.'/views/inc/footer_area.php'; ?>
<?php require APPROOT.'/views/inc/modal_unscribing.php'; ?>
<?php require APPROOT . '/views/inc/footer.php'; ?>
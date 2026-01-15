<?= $this->extend('layouts/base'); ?>
<?=  $this->section("content"); ?>
<div class="col-sm-2">
</div>
<div class="col-sm-8">
    <form method="post"  id="form">
        <div class="row">
            <div class="col-sm-9">
                <h4 class="text-center">User Creation</h4>
            </div>
            <div class="col-sm-3">                 
                <button type="button" class="btn btn-primary float-end " onclick="history.back();" ><i class="fa fa-arrow-left"></i></button> 
                <button type="button" class="btn btn-primary float-end me-3"><i class="fa fa-trash"></i></button>
                <button type="button" class="btn btn-primary float-end me-3"><i class="fa fa-edit"></i></button>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">User ID</label>
            <input class="form-control" type="text" name="user_id" value="<?= set_value('user_id', isset($user->user_id) ? $user->user_id : '') ?>" autocomplete="off">
            
        </div>
        <div class="form-group">
            <label class="form-label">Email ID</label>
            <input class="form-control" type="text" name="mail_id" value="<?= set_value('mail_id', isset($user->mail_id) ? $user->mail_id : '') ?>" autocomplete="off">
           
        </div> 
        <div class="form-group">
            <label class="form-label">User name</label>
            <input class="form-control" type="text" name="user_nm"value="<?= set_value('user_nm', isset($user->user_nm) ? $user->user_nm : '') ?>" autocomplete="off">               
            
        </div>
        <div class="form-group">
            <label class="form-label">Contact No</label>
            <input class="form-control" type="text" name="cell_no" value="<?= set_value('cell_no', isset($user->cell_no) ? $user->cell_no : '') ?>" autocomplete="off">               
            
        </div>
        <div class="form-group">
            <label class="form-label">Password </label>
            <input class="form-control"  type="password" name="pass_wd" id="pass_id" value="<?= set_value('pass_wd', '', false) ?>">
            
        </div>
        <div class="form-group">
            <label class="form-label">Confirm Pass </label>
            <input class="form-control"  type="password" name="cpas_wd" id="cpas_id" value="<?= set_value('cpas_wd', '', false) ?>">
           
        </div>
    </form>
</div>
<div class="col-sm-2">
    
</div>
<?= $this->endSection(); ?>
<?=  $this->section("side_bar"); ?>
<div class="row">
    <a href="users" class="">Users</a>
</div> 
<?= $this->endSection(); ?>
<?=  $this->section("jscript"); ?>
    <script>
        var mode = "<?php if(isset($mode)) { 
                                echo $mode; 
                            } else {
                                echo '';
                            }?>";
        switch(mode) {
            case 'view':
                // $('#form input').prop('readonly', true);
                 $('#form input').prop('disabled', true);
                break;
            case 'update' :
                $('#pass_wd').hide();
                $('#cpas_wd').hide();
                break;
            case 'delete':
                $('#form input').prop('readonly', true);
                break;
        }

    </script>
<?= $this->endSection(); ?>
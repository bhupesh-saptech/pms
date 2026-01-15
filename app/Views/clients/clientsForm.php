<?= $this->extend('layouts/base'); ?>
<?=  $this->section("content"); ?>
<div class="col-sm-2">
</div>
<div class="col-sm-8">
    <form method="post" id="form">
        <div class="form-group">
            <label class="form-label">Client ID</label>
            <input class="form-control" type="text" name="clients_id" value="<?= set_value('clients_id', isset($client->clients_id) ? $client->clients_id : '') ?>" <?php if($mode == 'create') {echo 'disabled';} ?>>
            
        </div>
        <div class="form-group">
            <label class="form-label">Client Name</label>
            <input class="form-control" type="text" name="clnts_name" value="<?= set_value('clnts_name', isset($client->clnts_name) ? $client->clnts_name : '') ?>" autocomplete="off">
           
        </div> 
        <div class="form-group">
            <label class="form-label">Email ID</label>
            <input class="form-control" type="text" name="csemail_id" value="<?= set_value('csemail_id', isset($client->csemail_id) ? $client->csemail_id : '') ?>" autocomplete="off">               
            
        </div>
        <div class="form-group">
            <label class="form-label">Contact No</label>
            <input class="form-control" type="text" name="cmobile_no" value="<?= set_value('cell_no', isset($client->cmobile_no) ? $client->cmobile_no : '') ?>" autocomplete="off">               
            
        </div>
        <div class="form-group">
            <button class="btn btn-primary " type="submit"> submit </button>
            <a href="users" class="btn btn-primary float-end"> back </a>
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
            case 'read':
                $('#form input').prop('readonly', true);
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
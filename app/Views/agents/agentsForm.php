<?= $this->extend('layouts/base'); ?>
<?=  $this->section("content"); ?>
<div class="col-sm-2">
</div>
<div class="col-sm-8">
    <form method="post"  id="form">
        <div class="row">
            <div class="col-sm-9">
                <h4 class="text-center">Task Creation</h4>
            </div>
            <div class="col-sm-3">                 
                <button type="button" class="btn btn-primary float-end " onclick="history.back();" ><i class="fa fa-arrow-left"></i></button> 
                <button type="button" class="btn btn-primary float-end me-3"><i class="fa fa-trash"></i></button>
                <button type="button" class="btn btn-primary float-end me-3"><i class="fa fa-edit"></i></button>
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Agents ID</label>
            <input class="form-control" type="text" name="agent_id" value="<?= set_value('agent_id', isset($agent->agent_id) ? $agent->agent_id : '') ?>" autocomplete="off">
            
        </div>
        <div class="form-group">
            <label class="form-label">First Name</label>
            <input class="form-control" type="text" name="first_name" value="<?= set_value('first_name', isset($agent->first_name) ? $agemt->first_name : '') ?>" autocomplete="off">
        </div>
        <div class="form-group">
            <label class="form-label">Last Name</label>
            <input class="form-control" type="text" name="last_name" value="<?= set_value('last_name', isset($agent->last_name) ? $agent->last_name : '') ?>" autocomplete="off">
           
        </div>
        <div class="form-group">
            <label class="form-label">Email ID</label>
            <input class="form-control" type="text" name="email_id" value="<?= set_value('email_id', isset($agent->email_id) ? $agent->email_id : '') ?>" autocomplete="off">
           
        </div> 
        <div class="form-group">
            <label class="form-label">Agent name</label>
            <input class="form-control" type="text" name="agent_nm"value="<?= set_value('agent_nm', isset($agent->agent_nm) ? $agent->agent_nm : '') ?>" autocomplete="off">                         
        </div>
        <div class="form-group">
            <label class="form-label">Contact No</label>
            <input class="form-control" type="text" name="mobile_no" value="<?= set_value('mobile_no', isset($agent->mobile_no) ? $agent->mobile_no : '') ?>" autocomplete="off">                
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
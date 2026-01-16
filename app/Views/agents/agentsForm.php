<?= $this->extend('layouts/base'); ?>
<?=  $this->section("content"); ?>
<div class="col-sm-2">
</div>
<div class="col-sm-8">
    <form method="post"  id="form">
        <div class="row">
            <div class="col-sm-9">
                <h4 class="text-center">Agent Creation</h4>
            </div>
            <div class="col-sm-3">                 
                <button type="button" class="btn btn-secondary float-end " onclick="history.back();" ><i class="fa fa-arrow-left"></i></button>
                <?php if($mode == 'create') : ?> 
                    <button type="submit" class="btn btn-success float-end me-3"><i class="fa fa-save"></i></button>
                <?php else : ?>
                    <button type="button" class="btn btn-warning float-end me-3" onclick="btnToggle(this,event);"><i class="fa fa-edit"></i></button>
                    <a href="agents/delete/<?= $agent->agent_id ?>" class="btn btn-danger float-end me-3" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa fa-trash"></i></a>
                <?php endif ?>
                <input  type="hidden" name="agent_id" id="agent_id" value="<?= set_value('agent_id', isset($agent->agent_id) ? $agent->agent_id : '') ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">First Name</label>
            <input class="form-control" type="text" name="first_name" value="<?= set_value('first_name', isset($agent->first_name) ? $agent->first_name : '') ?>" autocomplete="off">
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

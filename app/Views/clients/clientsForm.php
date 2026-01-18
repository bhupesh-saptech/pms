<?= $this->extend('layouts/base'); ?>
<?=  $this->section("content"); ?>
<div class="col-sm-2">
</div>
<div class="col-sm-8">
    <form method="post" id="form">
        <div class="row">
            <div class="col-sm-9">
                <h4 class="text-center">Client Creation</h4>
            </div>
            <div class="col-sm-3">                 
                <button type="button" class="btn btn-secondary float-end " onclick="history.back();" ><i class="fa fa-arrow-left"></i></button>
                <?php if($mode == 'create') : ?> 
                    <button type="submit" class="btn btn-success float-end me-3"><i class="fa fa-save"></i></button>
                <?php else : ?>
                    <button type="button" class="btn btn-warning float-end me-3" onclick="btnToggle(this,event);"><i class="fa fa-edit"></i></button>
                    <a href="clients/delete/<?= $client->client_id ?>" class="btn btn-danger float-end me-3" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa fa-trash"></i></a>
                <?php endif ?>
                <input  type="hidden" name="client_id" id="client_id" value="<?= set_value('client_id', isset($client->client_id) ? $client->client_id : '') ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Client Code</label>
            <input class="form-control" type="text" name="client_cd" value="<?= set_value('client_cd', isset($client->client_cd) ? $client->client_cd : '') ?>" autocomplete="off">   
        </div> 
        <div class="form-group">
            <label class="form-label">Client Name</label>
            <input class="form-control" type="text" name="client_nm" value="<?= set_value('client_nm', isset($client->client_nm) ? $client->client_nm : '') ?>" autocomplete="off">
        </div> 
        <div class="form-group">
            <label class="form-label">Contact Name</label>
            <input class="form-control" type="text" name="contact_nm" value="<?= set_value('contact_nm', isset($client->contact_nm) ? $client->contact_nm : '') ?>" autocomplete="off">
        </div> 
        <div class="form-group">
            <label class="form-label">Mobile No</label>
            <input class="form-control" type="text" name="mobile_no" value="<?= set_value('mobile_no', isset($client->mobile_no) ? $client->mobile_no : '') ?>" autocomplete="off">               
        </div>
        <div class="form-group">
            <label class="form-label">Email ID</label>
            <input class="form-control" type="text" name="email_id" value="<?= set_value('email_id', isset($client->email_id) ? $client->email_id : '') ?>" autocomplete="off">               
        </div>
        <div class="form-group">
            <label class="form-label">Client Type</label>
            <option value="" <?if(isset($client->client_ty) && $client->client_ty == "") { echo 'selected'; }?>>select Client Type</option>
            <select class="form-select select2"  name="client_ty">
                    <option value="" <?php if(isset($client->cl_type) && $client->cl_type == "") { echo "selected";} ?>>Select Client Type</option>
                    <?php foreach($types as $param=>$value) :?>
                        <option value="<?= $param ?>" <?php if(isset($client->client_ty) && $client->client_ty == $param) { echo "selected";} ?>><?= $value ?></option>
                    <?php endforeach?>
            </select>                   
        </div>
        <div class="form-group">
            <label class="form-label">Client Industry</label>
            <option value="" <?if(isset($client->industry) && $client->industry == "") { echo 'selected'; }?>>select Industry</option>
            <select class="form-select select2"  name="industry">
                    <option value="" <?php if(isset($client->industry) && $client->industry == "") { echo "selected";} ?>>Select Industry</option>
                    <?php foreach($industry as $param=>$value) :?>
                        <option value="<?= $param ?>" <?php if(isset($client->industry) && $client->industry == $param) { echo "selected";} ?>><?= $value ?></option>
                    <?php endforeach; ?>
            </select>                   
        </div>
        <div class="form-group">
            <label class="form-label">Client Status</label>
            <select class="form-select select2"  name="status">
                    <option value="" <?php if(isset($client->status) && $client->status  == "") { echo "selected";} ?>>Select Status</option>
                    <?php foreach($status as $param=>$value) :?>
                        <option value="<?= $param ?>" <?php if(isset($client->status) && $client->status == $param) { echo "selected";} ?>><?= $value ?></option>
                    <?php endforeach; ?>
            </select>                   
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

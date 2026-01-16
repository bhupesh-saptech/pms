<?= $this->extend('layouts/base'); ?>
<?=  $this->section("content"); ?>
<div class="col-sm-2">
</div>
<div class="col-sm-8">
    <form method="post" id="form">
        <div class="row">
            <div class="col-sm-9">
                <h4 class="text-center">Issue Creation</h4>
            </div>
            <div class="col-sm-3">                 
                <button type="button" class="btn btn-secondary float-end " onclick="history.back();" ><i class="fa fa-arrow-left"></i></button>
                <?php if($mode == 'create') : ?> 
                    <button type="submit" class="btn btn-success float-end me-3"><i class="fa fa-save"></i></button>
                <?php else : ?>
                    <button type="button" class="btn btn-warning float-end me-3" onclick="btnToggle(this,event);"><i class="fa fa-edit"></i></button>
                    <a href="issues/delete/<?= $issue->issue_id ?>" class="btn btn-danger float-end me-3" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa fa-trash"></i></a>
                <?php endif ?>
                <input  type="hidden" name="issue_id" id="issue_id" value="<?= set_value('issue_id', isset($issue->issue_id) ? $issue->issue_id : '') ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Issue Title</label>
            <input class="form-control" type="text" name="issue_title" value="<?= set_value('issue_title', isset($issue->issue_title) ? $issue->issue_title : '') ?>" autocomplete="off">
           
        </div> 
        <div class="form-group">
            <label class="form-label">Project ID</label>
            <select class="form-select select2" name="project_id" id="project_id">
                <?php foreach($projects as $project) : ?>
                <option value="<?= $project->project_id; ?>"><?= $project->project_nm; ?></option>
            <?php    endforeach; ?>
            </select> 
        </div>
        <div class="form-group">
            <label class="form-label">SAP Module</label>
            <select class="form-select select2" name="sap_module" id="sap_module">
                <?php foreach($module as $key=>$value) : ?>
                <option value="<?= $key; ?>"><?= $value; ?></option>
            <?php    endforeach; ?>
            </select> 
        </div>
        <div class="form-group">
            <label class="form-label">Issue Type</label>
            <select class="form-select select2" name="iss_type" id="iss_type">
                <?php foreach($types as $key=>$value) : ?>
                <option value="<?= $key; ?>"><?= $value; ?></option>
            <?php    endforeach; ?>
            </select> 
        </div>
        <div class="form-group">
            <label class="form-label">Agent ID</label>
            <select class="form-select select2" name="agent_id" id="agent_id">
                <?php foreach($agents as $agent) : ?>
                <option value="<?= $agent->agent_id; ?>"><?= $agent->agent_nm; ?></option>
            <?php    endforeach; ?>
            </select> 
        </div>
        <div class="form-group">
            <label class="form-label">Status</label>
            <select class="form-select select2" name="status" id="status">
                <?php foreach($status as $key=>$value) : ?>
                <option value="<?= $key; ?>"><?= $value; ?></option>
            <?php    endforeach; ?>
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

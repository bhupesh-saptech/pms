<?= $this->extend('layouts/base'); ?>
<?=  $this->section("content"); ?>
<div class="col-sm-2">
</div>
<div class="col-sm-8">
    <form method="post" id="form">
        <div class="form-group">
            <label class="form-label">Issue ID</label>
            <input class="form-control" type="text" name="issue_id" value="<?= set_value('issue_id', isset($issue->issue_id) ? $issue->agent_id : '') ?>" autocomplete="off">
            
        </div>
        <div class="form-group">
            <label class="form-label">Issue Title</label>
            <input class="form-control" type="text" name="is_title" value="<?= set_value('is_title', isset($issue->is_title) ? $issue->is_title : '') ?>" autocomplete="off">
           
        </div> 
        <div class="form-group">
            <label class="form-label">Project ID</label>
            <select class="form-select select2" name="proj_id" id="proj_id">
                <?php foreach($projects as $project) : ?>
                <option value="<?= $project->proj_id; ?>"><?= $project->ps_name; ?></option>
            <?php    endforeach; ?>
            </select> 
        </div>
        <div class="form-group">
            <label class="form-label">Issue Type</label>
            <input class="form-control" type="text" name="iss_type" value="<?= set_value('iss_type', isset($issue->iss_type) ? $issue->iss_type : '') ?>" autocomplete="off">               
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
            case 'view':
                $('#form input').prop('readonly', true);
                break;
            case 'edit' :
                $('#pass_wd').hide();
                $('#cpas_wd').hide();
                break;
            case 'delete':
                $('#form input').prop('readonly', true);
                break;
        }

    </script>
<?= $this->endSection(); ?>
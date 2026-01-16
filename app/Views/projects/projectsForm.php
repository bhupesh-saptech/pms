<?= $this->extend('layouts/base'); ?>
<?=  $this->section("content"); ?>
<div class="col-sm-2">
</div>
<div class="col-sm-8">
    <form method="post" id="form">
        <div class="row">
            <div class="col-sm-9">
                <h4 class="text-center">Project Creation</h4>
            </div>
            <div class="col-sm-3">                 
                <button type="button" class="btn btn-secondary float-end " onclick="history.back();" ><i class="fa fa-arrow-left"></i></button>
                <?php if($mode == 'create') : ?> 
                    <button type="submit" class="btn btn-success float-end me-3"><i class="fa fa-save"></i></button>
                <?php else : ?>
                    <button type="buttton" class="btn btn-warning float-end me-3" onclick="btnToggle(this,event);"><i class="fa fa-edit"></i></button>
                    <a href="projects/delete/<?= $project->project_id ?>" class="btn btn-danger float-end me-3" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa fa-trash"></i></a>
                <?php endif ?>
                <input  type="hidden" name="project_id" id="project_id" value="<?= set_value('project_id', isset($project->agent_id) ? $project->agent_id : '') ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Project CD</label>
            <input class="form-control" type="text" name="project_cd" value="<?= set_value('project_cd', isset($project->project_cd) ? $project->project_cd : '') ?>" autocomplete="off">
           
        </div> 
        <div class="form-group">
            <label class="form-label">Project name</label>
            <input class="form-control" type="text" name="project_nm"value="<?= set_value('project_nm', isset($project->project_nm) ? $project->project_nm : '') ?>" autocomplete="off">                      
        </div>
        <div class="form-group">
            <label class="form-label">Project Description</label>
            <textarea class="form-control" rows="3" name="proj_desc"value="<?= set_value('proj_desc', isset($project->proj_desc) ? $project->proj_desc : '') ?>" autocomplete="off"></textarea>               
        </div>
        <div class="form-group">
            <label class="form-label">Project type</label>
            <select class="form-select" name="proj_type">
                <option value="" <?php if($project->proj_type == "") { echo "selected";} ?>>select project type</option>
                <?php foreach($types as $key=>$value): ?>
                    <option value="<?= $key ?>" <?php if($project->proj_type == $key ) { echo "selected";} ?>><?= $value; ?></option>
                <?php endforeach;?>
            </select>               
        </div>
        <div class="form-group">
            <label class="form-label">Project Category</label>
            <select class="form-select" name="proj_catg" >
                <option value="">select project Category</option>
                <?php foreach($category as $key=>$value): ?>
                    <option value="<?= $key ?>" <?php if($project->proj_catg == $key ) { echo "selected";} ?>><?= $value; ?></option>
                <?php endforeach;?>
            </select>

            
        </div>
        <div class="form-group">
            <label class="form-label">Client Name</label>
            <select class="form-select" name="client_id">
                <option value="">select client</option>
                <?php foreach($clients as $client) :?>
                    <option value="<?= $client->client_id; ?>" <?php if($project->client_id == $client->client_id ) { echo "selected";} ?>><?= $client->client_nm; ?></option>
                <?php endforeach;?>
            </select>                
        </div>
        <div class="form-group">
            <label class="form-label">Project Manager</label>
            <select class="form-select"  name="agent_id" >
                <option value="">select Project Manager</option>
                <?php foreach( $agents as $agent) :?>
                    <option value="<?= $agent->agent_id; ?>" <?php if($project->agent_id == $agent->agent_id ) { echo "selected";} ?> ><?= $agent->agent_nm; ?></option>
                <?php endforeach; ?>
            </select>               
        </div>
        <div class="form-group">
            <label class="form-label">Start Date </label>
            <input class="form-control"  type="date" name="start_dt" id="start_dt" value="<?= set_value('start_dt', isset($project->start_dt) ? $project->start_dt : '') ?>">
        </div>
        <div class="form-group">
            <label class="form-label">Finish Date </label>
            <input class="form-control"  type="date" name="finish_dt" id="finish_dt" value="<?= set_value('finish_dt', isset($project->finish_dt) ? $project->finish_dt : '') ?>">
        </div>
        <div class="form-group">
            <label class="form-label">Project Status </label>
            <select class="form-select"  name="status" id="status" >
                <option value="">-- Select Status --</option>
                <?php foreach($status as $key=>$value): ?>
                    <option value="<?= $key ?>" <?php if($project->status == $key ) { echo "selected";} ?>><?= $value; ?></option>
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
<?=  $this->section("jscript"); ?>
    <script>
        var mode = "<?php if(isset($mode)) { 
                                echo $mode; 
                            } else {
                                echo '';
                            }?>";
        switch(mode) {
            case 'view':
                $('#form input'   ).prop('disabled', true);
                $('#form select'  ).prop('disabled', true);
                $('#form textarea').prop('disabled', true);
                break;
            case 'update' :
                $('#pass_wd').hide();
                $('#cpas_wd').hide();
                break;
            case 'delete':
                $('#form input').prop('readonly', true);
                break;
        }
        function btnToggle(obj,event) {
            if (obj.type === "button") {
                    form = $(obj).closest('form');
                    form.find("input").prop('disabled',false);
                    form.find("select").prop('disabled',false);
                    obj.type = "submit"; // ✅ Change to submit
                    event.preventDefault();
                    obj.innerHTML = '<i class="fa fa-save"></i>';
            } 
    }

    </script>
<?= $this->endSection(); ?>
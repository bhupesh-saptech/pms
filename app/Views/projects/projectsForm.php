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
                    <button type="button" class="btn btn-warning float-end me-3" onclick="btnToggle(this,event);"><i class="fa fa-edit"></i></button>
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
                <option value="" <?php if(isset($project->proj_type) && $project->proj_type == "") { echo "selected";} ?>>select project type</option>
                <?php foreach($types as $param=>$value): ?>
                    <option value="<?= $param ?>" <?php if(isset($project->proj_type) && $project->proj_type == $param ) { echo "selected";} ?>><?= $value; ?></option>
                <?php endforeach;?>
            </select>               
        </div>
        <div class="form-group">
            <label class="form-label">Project Category</label>
            <select class="form-select" name="proj_catg" >
                <option value="" <?php if(isset($project->proj_catg) && $project->proj_catg == "" ) { echo "selected";} ?>>select project Category</option>
                <?php foreach($category as $param=>$value): ?>
                    <option value="<?= $param ?>" <?php if(isset($project->proj_catg) && $project->proj_catg == $param ) { echo "selected";} ?>><?= $value; ?></option>
                <?php endforeach;?>
            </select>

            
        </div>
        <div class="form-group">
            <label class="form-label">Client Name</label>
            <select class="form-select" name="client_id">
                <option value="" <?php if(isset($project->client_id) &&  $project->client_id == "" ) { echo "selected";} ?>>select client</option>
                <?php foreach($clients as $client) :?>
                    <option value="<?= $client->client_id; ?>" <?php if(isset($project->client_id) &&  $project->client_id == $client->client_id ) { echo "selected";} ?>><?= $client->client_nm; ?></option>
                <?php endforeach;?>
            </select>                
        </div>
        <div class="form-group">
            <label class="form-label">Project Manager</label>
            <select class="form-select"  name="agent_id" >
                <option value="" <?php if(isset($project->agent_id) && $project->agent_id == "" ) { echo "selected";} ?>>select Project Manager</option>
                <?php foreach( $agents as $agent) :?>
                    <option value="<?= $agent->agent_id; ?>" <?php if(isset($project->agent_id) && $project->agent_id == $agent->agent_id ) { echo "selected";} ?> ><?= $agent->agent_nm; ?></option>
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
                <option value="" <?php if(isset($project->status) && $project->status == "" ) { echo "selected";} ?>>-- Select Status --</option>
                <?php foreach($status as $param=>$value): ?>
                    <option value="<?= $param ?>" <?php if(isset($project->status) && $project->status == $param ) { echo "selected";} ?>><?= $value; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </form>
</div>
<div class="col-sm-2">
    
</div>
<?= $this->endSection(); ?>


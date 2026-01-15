<?= $this->extend('layouts/base'); ?>
<?=  $this->section("content"); ?>
<div class="col-sm-2">
</div>
<div class="col-sm-8">
    <form method="post"  id="form">
         <div class="d-grid">
            <button type="submit" class="btn btn-primary">
                Save
            </button>
             <a href="users" class="btn btn-primary float-end"> back </a>
        </div>
        <div class="form-group">
            <label class="form-label">Task ID</label>
            <input class="form-control" type="text" name="task_id" value="<?= set_value('task_id', isset($task->task_id) ? $task->task_id : '') ?>" autocomplete="off">
        </div>
        <div class="form-group">
            <label class="form-label">Title</label>
            <input class="form-control" type="text" name="task_title"value="<?= set_value('task_title', isset($task->ts_desc) ? $task->ts_desc : '') ?>" autocomplete="off">                          
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
            <label class="form-label">Agent ID</label>
            <select class="form-select selectpicker" name="agent_id" id="agent_id">
                <?php foreach($agents as $agent) : ?>
                <option value="<?= $agent->agent_id; ?>"><?= $agent->agent_nm; ?></option>
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
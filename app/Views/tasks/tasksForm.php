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
                <button type="button" class="btn btn-secondary float-end " onclick="history.back();" ><i class="fa fa-arrow-left"></i></button>
                <?php if($mode == 'create') : ?> 
                    <button type="submit" class="btn btn-success float-end me-3"><i class="fa fa-save"></i></button>
                <?php else : ?>
                    <button type="button" class="btn btn-warning float-end me-3" onclick="btnToggle(this,event);"><i class="fa fa-edit"></i></button>
                    <a href="tasks/delete/<?= $task->task_id ?>" class="btn btn-danger float-end me-3" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa fa-trash"></i></a>
                <?php endif ?>
                <input  type="hidden" name="task_id" id="task_id" value="<?= set_value('task_id', isset($task->task_id) ? $task->task_id : '') ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Project ID</label>
            <select class="form-select select2" name="project_id" id="project_id">
                <option value="" <?php if(isset($task->project_id) && $task->project_id == "") {echo 'selected';}?>></option>
                <?php foreach($projects as $project) : ?>
                <option value="<?= $project->project_id; ?>" <?php if(isset($task->project_id) && $task->project_id == $project->project_id) {echo 'selected';}?>><?= $project->project_nm; ?></option>
            <?php    endforeach; ?>
            </select> 
        </div> 
        <div class="form-group">
            <label class="form-label">Ticket ID</label>
            <select class="form-select select2" name="ticket_id" id="ticket_id">
                <option value="" <?php if(isset($task->ticket_id) && $task->ticket_id == "") {echo 'selected';}?>></option>
                <?php foreach($projects as $project) : ?>
                <option value="<?= $project->ticket_id; ?>" <?php if(isset($task->ticket_id) && $task->ticket_id == $project->ticket_id) {echo 'selected';}?>><?= $project->ticket_nm; ?></option>
            <?php    endforeach; ?>
            </select> 
        </div> 
        <div class="form-group">
            <label class="form-label">Task Title</label>
            <input class="form-control" type="text" name="task_nm" value="<?= set_value('task_nm', isset($task->task_nm) ? $task->task_nm : '') ?>" autocomplete="off">                          
        </div>
        <div class="form-group">
            <label class="form-label">Team Name</label>
            <select class="form-select select2" name="team_id" id="team_id">
                <option value="" <?php if(isset($task->team_id) && $task->team_id == "" ){ echo 'selected';} ?>>Select team name</option>
                <?php foreach($teams as $team) : ?>
                <option value="<?= $team->team_id; ?>" <?php if(isset($task->team_id) && $task->team_id == $team->team_id ){ echo 'selected';} ?>><?= $team->team_nm; ?></option>
                <?php endforeach; ?>
            </select> 
        </div>
        <div class="form-group">
            <label class="form-label">Agent ID</label> 
            <select class="form-select select2" name="agent_id" id="agent_id">
                <option value="" <?php if(isset($task->agent_id) && $task->agent_id == "") {echo 'selected';}?>></option>
                <?php foreach($agents as $agent) : ?>
                <option value="<?= $agent->agent_id; ?>" <?php if(isset($task->agent_id) && $task->agent_id == $agent->agent_id ) {echo 'selected';} ?>><?= $agent->agent_nm; ?></option>
            <?php    endforeach; ?>
            </select> 
        </div>
        <div class="form-group">
            <label class="form-label">Status</label>
            <select class="form-select select2" name="status" id="status">
                <option value="" <?php if(isset($task->status) && $task->status == "") {echo 'selected';}?>></option>
                <?php foreach($status as $param=>$value) : ?>
                <option value="<?= $param; ?>" <?php if(isset($task->status) && $task->status == $param ) {echo 'selected';}?>><?= $value; ?></option>
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

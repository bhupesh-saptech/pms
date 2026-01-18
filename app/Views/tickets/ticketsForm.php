<?= $this->extend('layouts/base'); ?>
<?=  $this->section("content"); ?>
<div class="col-sm-2">
</div>
<div class="col-sm-8">
    <form method="post" id="form">
        <div class="row">
            <div class="col-sm-9">
                <h4 class="text-center">Ticket Creation</h4>
            </div>
            <div class="col-sm-3">                 
                <button type="button" class="btn btn-secondary float-end " onclick="history.back();" ><i class="fa fa-arrow-left"></i></button>
                <?php if($mode == 'create') : ?> 
                    <button type="submit" class="btn btn-success float-end me-3"><i class="fa fa-save"></i></button>
                <?php else : ?>
                    <button type="button" class="btn btn-warning float-end me-3" onclick="btnToggle(this,event);"><i class="fa fa-edit"></i></button>
                    <a href="tickets/delete/<?= $ticket->ticket_id ?>" class="btn btn-danger float-end me-3" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa fa-trash"></i></a>
                <?php endif ?>
                <input  type="hidden" name="ticket_id" id="ticket_id" value="<?= set_value('ticket_id', isset($ticket->ticket_id) ? $ticket->ticket_id : '') ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Project ID</label>
             <option value="" <?php if(isset($ticket->project_id) && $ticket->project_id == "" ){ echo 'selected';} ?>>Select Project name</option>
            <select class="form-select select2" name="project_id" id="project_id">
                <?php foreach($projects as $project) : ?> <option value="<?= $project->project_id; ?>" <?php if(isset($ticket->project_id) && $ticket->project_id == $project->project_id ){ echo 'selected';} ?>><?= $project->project_nm; ?></option>
                
                <option value="<?= $project->project_id; ?>"><?= $project->project_nm; ?></option>
            <?php    endforeach; ?>
            </select> 
        </div>
        <div class="form-group">
            <label class="form-label">Ticket Title</label>
            <input class="form-control" type="text" name="ticket_nm" value="<?= set_value('ticket_nm', isset($ticket->ticket_nm) ? $ticket->ticket_nm : '') ?>" autocomplete="off">
        </div> 
        <div class="form-group">
            <label class="form-label">SAP Module</label>
            <select class="form-select select2" name="module" id="sap_module">
                <?php foreach($module as $param=>$value) : ?>
                <option value="<?= $param; ?>"><?= $value; ?></option>
            <?php    endforeach; ?>
            </select> 
        </div>
        <div class="form-group">
            <label class="form-label">Ticket Type</label>
            <select class="form-select select2" name="ticket_ty" id="ticket_ty">
                <?php foreach($types as $param=>$value) : ?>
                <option value="<?= $param; ?>"><?= $value; ?></option>
            <?php    endforeach; ?>
            </select> 
        </div>
        <div class="form-group">
            <label class="form-label">Team Name</label>
            <select class="form-select select2" name="team_id" id="team_id">
                <option value="" <?php if(isset($ticket->team_id) && $ticket->team_id == "" ){ echo 'selected';} ?>>Select team name</option>
                <?php foreach($teams as $team) : ?>
                <option value="<?= $team->team_id; ?>" <?php if(isset($ticket->team_id) && $ticket->team_id == $team->team_id ){ echo 'selected';} ?>><?= $team->team_nm; ?></option>
                <?php endforeach; ?>
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
                <?php foreach($status as $param=>$value) : ?>
                <option value="<?= $param; ?>"><?= $value; ?></option>
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

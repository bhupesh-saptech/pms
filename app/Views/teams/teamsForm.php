<?= $this->extend('layouts/base'); ?>
<?=  $this->section("content"); ?>
<div class="col-sm-2">
</div>
<div class="col-sm-8">
    <form method="post" id="form">
        <div class="row">
            <div class="col-sm-9">
                <h4 class="text-center">team Creation</h4>
            </div>
            <div class="col-sm-3">                 
                <button type="button" class="btn btn-secondary float-end " onclick="history.back();" ><i class="fa fa-arrow-left"></i></button>
                <?php if($mode == 'create') : ?> 
                    <button type="submit" class="btn btn-success float-end me-3"><i class="fa fa-save"></i></button>
                <?php else : ?>
                    <button type="button" class="btn btn-warning float-end me-3" onclick="btnToggle(this,event);"><i class="fa fa-edit"></i></button>
                    <a href="teams/delete/<?= $team->team_id ?>" class="btn btn-danger float-end me-3" onclick="return confirm('Are you sure you want to delete this record?');"><i class="fa fa-trash"></i></a>
                <?php endif ?>
                <input  type="hidden" name="team_id" id="team_id" value="<?= set_value('team_id', isset($team->team_id) ? $team->team_id : '') ?>">
            </div>
        </div>
        <div class="form-group">
            <label class="form-label">Team Code</label>
            <input class="form-control" type="text" name="team_cd" value="<?= set_value('team_cd', isset($team->team_cd) ? $team->team_cd : '') ?>" autocomplete="off">
        </div> 
        <div class="form-group">
            <label class="form-label">Team Name</label>
            <input class="form-control" type="text" name="team_nm" value="<?= set_value('team_nm', isset($team->team_nm) ? $team->team_nm : '') ?>" autocomplete="off">
        </div>       
        <div class="form-group">
            <label class="form-label">Team Type</label>
            <select class="form-select select2" name="team_ty" id="iss_type">
                <?php foreach($types as $param=>$value) : ?>
                <option value="<?= $param; ?>"><?= $value; ?></option>
            <?php    endforeach; ?>
            </select> 
        </div>
        <div class="form-group">
            <label class="form-label">Team Lead</label>
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

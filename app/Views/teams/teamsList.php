<?=  $this->extend('layouts/base'); ?>
<?=  $this->section("dashboard"); ?>
<?= $this->include('layouts/dashboard'); ?>
<?=  $this->endSection(); ?>
<?=  $this->section("content"); ?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-4">
                    <h5 class="card-title">List of Teams</h1>
                </div>
                <div class="col-sm-8">
                    <a href="teams/create" class="btn btn-primary float-end">Create Team</a>
                </div>
            </div>  
        </div>
        <div class="card-body">
            <table class="table table-stripped table-bordered">
                <tr>
                    <th>Team ID</th>
                    <th>Team Cd</th>
                    <th>Team Name</th>
                    <th>Team Type</th>
                    <th>Team Lead</th>
                    <th>Status</th>
                    <th>Tickets</th>
                    <th>Tasks</th>
                </tr>
                <?php foreach($teams as $team): ?>
                    <tr>
                        <td><?= $team->team_id ?></td>
                        <td><?= $team->team_cd ?></td>
                        <td><a href="teams/update/<?= $team->team_id ?>"><?= $team->team_nm ?></td>
                        <td><?= $types[$team->team_ty] ?? null; ?></td>
                        <td><?= $team->agent_nm ?></td>
                        <td><?= $status[$team->status] ?? null; ?></td>
                        <td class="text-center text-success"><a href="tickets?team_id=<?= $team->team_id ?>"><i class="fa-solid fa-ticket"></i></a></i></td>
                        <td class="text-center text-success"><a href="tasks?team_id=<?= $team->team_id ?>"><i class="fas fa-tasks"></i></a></td>
                        
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<?=  $this->endSection(); ?>


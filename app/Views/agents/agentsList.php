<?=  $this->extend('layouts/base'); ?>
<?= $this->section("dashboard"); ?>
<?= $this->include('layouts/dashboard'); ?>
<?=  $this->endSection(); ?> 

<?=  $this->section("content"); ?>

<div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-sm-4">
                    <h5 class="card-title">List of Agents</h1>
                </div>
                <div class="col-sm-8">
                    <a href="agents/create" class="btn btn-primary float-end">Create Agent</a>
                </div>
            </div>  
        </div>
        <div class="card-body">
            <table class="table table-stripped table-bordered">
                <tr>
                    <th>Agent ID</th>
                    <th>Agent Name</th>
                    <th>Email ID</th>
                    <th>Emp ID</th>
                    <th>Cell Number</th>
                    <th>Created At</th>
                </tr>
                <?php foreach($agents as $agent): ?>
                    <tr>
                        <td><?= $agent->agent_id ?></td>
                        <td><a href="agents/view/<?= $agent->agent_id ?>"><?= $agent->agent_nm ?></a></td>
                        <td><?= $agent->email_id ?></td>
                        <td><?= $agent->emp_id ?></td>
                        <td><?= $agent->mobile_no ?></td>
                        <td><?= $agent->created_at ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<?=  $this->endSection(); ?>


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
                    <h5 class="card-title">List of Issues</h1>
                </div>
                <div class="col-sm-8">
                    <a href="issues/create" class="btn btn-primary float-end">Create Issue</a>
                </div>
            </div>  
        </div>
        <div class="card-body">
            <table class="table table-stripped table-bordered">
                <tr>
                    <th>Issue ID</th>
                    <th>Issue Title</th>
                    <th>Project ID</th>
                    <th>Issue Type</th>
                    <th>SAP Module</th>
                    <th>Assigned to</th>
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
                <?php foreach($issues as $issue): ?>
                    <tr>
                        <td><?= $issue->issue_id ?></td>
                        <td><a href="issues/view/<?= $issue->issue_id ?>"><?= $issue->issue_title ?></td>
                        <td><?= $issue->project_nm ?></td>
                        <td><?= $types[$issue->iss_type] ?? null; ?></td>
                        <td><?= $module[$issue->sap_module] ?? null; ?></td>
                        <td><?= $issue->agent_nm ?></td>
                        <td><?= $status[$issue->status] ?? null; ?></td>
                        <td><?= $issue->created_at ?></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<?=  $this->endSection(); ?>
<?=  $this->section("side_bar"); ?>
<div class="row">
    <a href="users" class="">Users</a>
</div> 
<?= $this->endSection(); ?>

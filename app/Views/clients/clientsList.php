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
                    <h5 class="card-title">List of Clients</h1>
                </div>
                <div class="col-sm-8">
                    <a href="clients/create" class="btn btn-primary float-end">Create Client</a>
                </div>
            </div>  
        </div>
        <div class="card-body">
            <table class="table table-stripped table-bordered">
                <tr>
                    <th>Client ID</th>
                    <th>Client Name</th>
                    <th>Contact Name</th>
                    <th>Email ID</th>                 
                    <th>Mobile No</th>
                    <th>Client Type</th>
                    <th>Industry</th>
                    <th>status</th>
                    <th>Projects</th>
                </tr>
                <?php foreach($clients as $client): ?>
                    <tr>
                        <td><?= $client->client_id ?></td>
                        <td><a href="clients/update/<?= $client->client_id ?>"><?= $client->client_nm ?></a></td>
                        <td><?= $client->contact_nm ?></td>   
                        <td><?= $client->email_id ?></td>
                        <td><?= $client->mobile_no ?></td>
                        <td><?= $types[$client->cl_type] ?? null; ?></td>
                        <td><?= $industry[$client->industry] ?? null; ?></td>
                        <td><?= $status[$client->status] ?? null; ?></td>  
                        <td class="text-center text-primary"><i class="fa-solid fa-diagram-project"></i></td>                
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

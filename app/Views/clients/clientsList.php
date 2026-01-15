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
                    <th>Email ID</th>
                    <th>Client Contact</th>
                    <th>Cell Number</th>
                    <th>Created At</th>
                    <th class="text-center">View</th>
                    <th class="text-center">Edit</th>
                    <th class="text-center">Delete</th>
                </tr>
                <?php foreach($clients as $client): ?>
                    <tr>
                        <td><?= $client->client_id ?></td>
                        <td><?= $client->client_nm ?></td>
                        <td><?= $client->email_id ?></td>
                        <td></td>   
                        <td><?= $client->mobile_no ?></td>
                        <td><?= $client->created_at ?></td>
                        <td class="text-center"><a href="clients/view/<?= $client->client_id ?>"  ><i class="fa fa-eye"   ></i></a></td>
                        <td class="text-center"><a href="clients/edit/<?= $client->client_id ?>"  ><i class="fa fa-edit"  ></i></a></td>
                        <td class="text-center"><a href="clients/delete/<?= $client->client_id ?>"><i class="fa fa-trash" ></i></a></td>
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

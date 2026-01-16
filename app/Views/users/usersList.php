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
                    <h5 class="card-title">List of Users</h1>
                </div>
                <div class="col-sm-8">
                    <a href="users/create" class="btn btn-primary float-end">Create User</a>
                </div>
            </div>  
        </div>
        <div class="card-body">
            <table class="table table-stripped table-bordered">
                <tr>
                    <th>User ID</th>
                    <th>User Name</th>
                    <th>Email ID</th>
                    <th>User Real Name</th>
                    <th>Cell Number</th>
                    <th>Created At</th>
                </tr>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td><?= $user->user_id ?></td>
                        <td><a href="users/update/<?= $user->user_id ?>"><?= $user->user_nm ?></a></td>
                        <td><?= $user->mail_id ?></td>
                        <td><?= $user->real_name ?></td>
                        <td><?= $user->cell_no ?></td>
                        <td><?= $user->created_at ?></td>
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

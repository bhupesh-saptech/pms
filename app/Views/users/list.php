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
                    <th>UserID</th>
                    <th>Username</th>
                    <th>Email ID</th>
                    <th>User Real Name</th>
                    <th>Cell Number</th>
                    <th>Created At</th>
                    <th class="text-center">View</th>
                    <th class="text-center">Edit</th>
                    <th class="text-center">Delete</th>
                </tr>
                <?php foreach($users as $user): ?>
                    <tr>
                        <td><?= $user->id ?></td>
                        <td><?= $user->user_id ?></td>
                        <td><?= $user->mail_id ?></td>
                        <td><?= $user->user_nm ?></td>
                        <td><?= $user->cell_no ?></td>
                        <td><?= $user->created_at ?></td>
                        <td class="text-center"><a href="users/view/1"><i class="fa fa-eye"   ></i></a></td>
                        <td class="text-center"><a href="users/edit/1"><i class="fa fa-edit"  ></i></a></td>
                        <td class="text-center"><a href="users/delete/1"><i class="fa fa-trash" ></i></a></td>
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

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
                    <h5 class="card-title">List of Tasks</h1>
                </div>
                <div class="col-sm-8">
                    <a href="tasks/create" class="btn btn-primary float-end">Create Task</a>
                </div>
            </div>  
        </div>
        <div class="card-body">
            <table class="table table-stripped table-bordered">
                <tr>
                    
                    <th>Task ID</th>
                    <th>Task Title</th>
                    <th>Project ID</th>
                    <th>Assigned to</th>
                    <th>Created At</th>
                    <th class="text-center">View</th>
                    <th class="text-center">Edit</th>
                    <th class="text-center">Delete</th>
                </tr>
                <?php foreach($tasks as $task): ?>
                    <tr>
                        <td><?= $task->task_id ?></td>
                        <td><?= $task->task_title ?></td>
                        <td><?= $task->ps_name ?></td>
                        <td><?= $task->agent_nm ?></td>
                        <td><?= $task->created_at ?></td>
                        <td class="text-center"><a href="tasks/read/1"><i class="fa fa-eye"   ></i></a></td>
                        <td class="text-center"><a href="tasks/update/1"><i class="fa fa-edit"  ></i></a></td>
                        <td class="text-center"><a href="tasks/delete/1"><i class="fa fa-trash" ></i></a></td>
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

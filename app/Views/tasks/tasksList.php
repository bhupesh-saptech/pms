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
                    <th>Status</th>
                    <th>Created At</th>
                </tr>
                <?php foreach($tasks as $task): ?>
                    <tr>
                        <td><?= $task->task_id ?></td>
                        <td><a href="tasks/update/<?= $task->task_id ?>"><?= $task->task_title ?></a></td>
                        <td><?= $task->ps_name ?></td>
                        <td><?= $task->agent_nm ?></td>
                        <td><?= $status[$task->status] ?? null; ?></td>
                        <td><?= $task->created_at ?></td>
                        
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

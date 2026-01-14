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
                    <h5 class="card-title">List of Projects</h1>
                </div>
                <div class="col-sm-8">
                    <a href="projects/create" class="btn btn-primary float-end">Create Project</a>
                </div>
            </div>  
        </div>
        <div class="card-body">
            <table class="table table-stripped table-bordered">
                <tr>
                    <th>Project ID</th>
                    <th>Project Cd</th>
                    <th>Project Name</th>
                    <th>Project Cat</th>
                    <th>Project Type</th>
                    <th>Project Manager</th>
                    <th>Client ID</th>
                    <th class="text-center">View</th>
                    <th class="text-center">Edit</th>
                    <th class="text-center">Delete</th>
                </tr>
                <?php foreach($projects as $project): ?>
                    <tr>
                        <td><?= $project->project_id ?></td>
                        <td><?= $project->project_cd ?></td>
                        <td><?= $project->project_nm ?></td>
                        <td><?= $project->proj_catg ?></td>
                        <td><?= $project->proj_type ?></td>
                        <td><?= $project->agent_nm ?></td>
                        <td><?= $project->client_nm ?></td>
                        
                        <td class="text-center"><a href="projects/view/1"><i class="fa fa-eye"   ></i></a></td>
                        <td class="text-center"><a href="projects/edit/1"><i class="fa fa-edit"  ></i></a></td>
                        <td class="text-center"><a href="projects/delete/1"><i class="fa fa-trash" ></i></a></td>
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

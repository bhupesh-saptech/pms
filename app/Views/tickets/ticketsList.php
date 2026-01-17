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
                    <h5 class="card-title">List of Tickets</h1>
                </div>
                <div class="col-sm-8">
                    <a href="tickets/create" class="btn btn-primary float-end">Create ticket</a>
                </div>
            </div>  
        </div>
        <div class="card-body">
            <table class="table table-stripped table-bordered">
                <tr>
                    <th>Ticket ID</th>
                    <th>Ticket Title</th>
                    <th>Project ID</th>
                    <th>Ticket Type</th>
                    <th>Module</th>
                    <th>Assigned to</th>
                    <th>Status</th>
                    <th>Tasks</th>
                </tr>
                <?php foreach($tickets as $ticket): ?>
                    <tr>
                        <td><?= $ticket->ticket_id ?></td>
                        <td><a href="tickets/update/<?= $ticket->ticket_id ?>"><?= $ticket->ticket_nm ?></td>
                        <td><?= $ticket->project_nm ?></td>
                        <td><?= $types[$ticket->ticket_ty] ?? null; ?></td>
                        <td><?= $module[$ticket->module] ?? null; ?></td>
                        <td><?= $ticket->agent_nm ?></td>
                        <td><?= $status[$ticket->status] ?? null; ?></td>
                        <td class="text-center text-success"><i class="fas fa-tasks"></i></td>
                        
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </div>
</div>
<?=  $this->endSection(); ?>


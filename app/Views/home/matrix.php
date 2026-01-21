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
                    <h5 class="card-title">agentwise summary</h1>
                </div>
                <div class="col-sm-8">
                </div>
            </div>  
        </div>
        <div class="card-body">
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="tab-a-tab" data-bs-toggle="tab" href="#tab-a"> Tickets</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="tab-b" data-bs-toggle="tab" href="#tab-b" >Tasks</a>
                </li>
            </ul>
            <div class="tab-pane active" id="tab-a">
                <table class="table table-stripped table-bordered">

                    <tr>
                        <th style="width:10%;">Agent ID</th>
                        <th style="width:25%;">Agent Name</th>
                        <?php foreach($status as $param=>$value) : ?>
                            <th style="width:10%;" class="text-end"><?= $value ?></th>
                        <?php endforeach; ?>
                        <th>Open Tickets</th>
                    </tr>
                    <?php foreach($tickets as $ticket): ?>
                        <tr>
                            <td class="text-start"><?= $ticket->agent_id ?></td>
                            <td class="text-start"><?= $ticket->agent_nm ?></td>
                            <td class="text-end"><a href="tickets?agent_id=<?= $ticket->agent_id ?>&status=0"><?= $ticket->status_00 ?></a></td>
                            <td class="text-end"><a href="tickets?agent_id=<?= $ticket->agent_id ?>&status=1"><?= $ticket->status_01 ?></a></td>
                            <td class="text-end"><a href="tickets?agent_id=<?= $ticket->agent_id ?>&status=2"><?= $ticket->status_02 ?></a></td>
                            <td class="text-end"><a href="tickets?agent_id=<?= $ticket->agent_id ?>&status=3"><?= $ticket->status_03 ?></a></td>
                            <td class="text-end"><a href="tickets?agent_id=<?= $ticket->agent_id ?>&status=4"><?= $ticket->status_04 ?></a></td>
                            <td class="text-end"><a href="tickets?agent_id=<?= $ticket->agent_id ?>&status=5"><?= $ticket->status_05 ?></a></td>
                            <td class="text-end"><a href="tickets?agent_id=<?= $ticket->agent_id ?>&status=o"><?= $ticket->status_00 +
                                                                                                                $ticket->status_01 +
                                                                                                                $ticket->status_02 +
                                                                                                                $ticket->status_03 +
                                                                                                                $ticket->status_04 +
                                                                                                                $ticket->status_05?></a></td>        
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <div class="tab-pane" id="tab-b" >
                <table class="table table-stripped table-bordered">
                    <tr>
                        <th>Agent ID</th>
                        <th>Agent Name</th>
                        <?php foreach($status as $param=>$value) : ?>
                            <th class="text-end"><?= $value ?></th>
                        <?php endforeach; ?>
                        <th>Open Tasks</th>
                    </tr>
                    <?php foreach($tasks as $task): ?>
                        <tr>
                            <td class="text-start"><?= $task->agent_id ?></td>
                            <td class="text-start"><?= $task->agent_nm ?></td>
                            <td class="text-end"><a href="tasks?agent_id=<?= $task->agent_id ?>&status=0"><?= $task->status_00 ?></a></td>
                            <td class="text-end"><a href="tasks?agent_id=<?= $task->agent_id ?>&status=1"><?= $task->status_01 ?></a></td>
                            <td class="text-end"><a href="tasks?agent_id=<?= $task->agent_id ?>&status=2"><?= $task->status_02 ?></a></td>
                            <td class="text-end"><a href="tasks?agent_id=<?= $task->agent_id ?>&status=3"><?= $task->status_03 ?></a></td>
                            <td class="text-end"><a href="tasks?agent_id=<?= $task->agent_id ?>&status=4"><?= $task->status_04 ?></a></td>
                            <td class="text-end"><a href="tasks?agent_id=<?= $task->agent_id ?>&status=5"><?= $task->status_05 ?></a></td>
                            <td class="text-end"><a href="tasks?agent_id=<?= $task->agent_id ?>&status=5"><?= $task->status_00 +
                                                                                                                $task->status_01 +
                                                                                                                $task->status_02 +
                                                                                                                $task->status_03 +
                                                                                                                $task->status_04 +
                                                                                                                $task->status_05?></a></td>        
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
        </div>
    </div>
</div>
<?=  $this->endSection(); ?>
<?=  $this->section("side_bar"); ?>
<div class="row">
    <a href="users" class="">Users</a>
</div> 
<?= $this->endSection(); ?>

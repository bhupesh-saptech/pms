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
            <table class="table table-stripped table-bordered">
                <tr>
                    
                    <th>Agent ID</th>
                    <th>Agent Name</th>
                    <?php foreach($status as $param=>$value) : ?>
                        <th class="text-end"><?= $value ?></th>
                    <?php endforeach; ?>
                </tr>
                <?php foreach($list as $item): ?>
                    <tr>
                        <td class="text-start"><?= $item->agent_id ?></td>
                        <td class="text-start"><?= $item->agent_nm ?></td>
                        <td class="text-end"><a href="tickets?agent_id=<?= $item->agent_id ?>&status=0"><?= $item->status_00 ?></a></td>
                        <td class="text-end"><a href="tickets?agent_id=<?= $item->agent_id ?>&status=1"><?= $item->status_00 ?></a></td>
                        <td class="text-end"><a href="tickets?agent_id=<?= $item->agent_id ?>&status=2"><?= $item->status_00 ?></a></td>
                        <td class="text-end"><a href="tickets?agent_id=<?= $item->agent_id ?>&status=3"><?= $item->status_00 ?></a></td>
                        <td class="text-end"><a href="tickets?agent_id=<?= $item->agent_id ?>&status=4"><?= $item->status_00 ?></a></td>
                        <td class="text-end"><a href="tickets?agent_id=<?= $item->agent_id ?>&status=5"><?= $item->status_00 ?></a></td>        
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

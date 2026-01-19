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
                    <th>Status-00</th>
                    <th>Status-01</th>
                    <th>Status-02</th>
                    <th>Status-03</th>
                    <th>Status-04</th>
                    <th>Status-05</th>
                    <th>Status-06</th>
                </tr>
                <?php foreach($list as $item): ?>
                    <tr>
                        <td class="text-start"><?= $item->agent_id ?></td>
                        <td class="text-start"><?= $item->agent_nm ?></td>
                        <td class="text-end"><?= $item->status_00 ?></td>
                        <td class="text-end"><?= $item->status_01 ?></td>
                        <td class="text-end"><?= $item->status_02 ?></td>
                        <td class="text-end"><?= $item->status_03 ?></td>
                        <td class="text-end"><?= $item->status_04 ?></td>
                        <td class="text-end"><?= $item->status_05 ?></td>
                        <td class="text-end"><?= $item->status_06 ?></td>
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

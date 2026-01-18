<?php if (session()->getFlashdata('status')): ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Hey!</strong>  <?= session()->getFlashdata('status') ?>
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
<?php endif;?>
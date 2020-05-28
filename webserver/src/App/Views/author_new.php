<?php
$this->extend('default_page'); ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="d-flex justify-content-center h-100 m-2">
        <div class="card">
            <div class="card-header">
                <h5>New Author</h5>
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo base_url('Author/add');?>" id="signin_form">
                    <?php if(isset($message)) {
                        ?>
                        <div class="alert alert-danger" role="alert">
                        <?= htmlspecialchars($message);?>
                        </div><?
                    } ?>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-feather-alt"></i></div>
                        </div>
                        <input type="text" name="name" class="form-control" placeholder="Author name" <?php if(isset($name)) echo 'value="', $name, '" ';?>/>
                    </div>
                    <input type="submit"/>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?><?= $this->endSection() ?>

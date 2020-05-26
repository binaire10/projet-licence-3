<?php
$this->extend('default_page'); ?>
<?= $this->section('content') ?>
<div class="container">
    <div class="d-flex justify-content-center h-100 m-2">
        <div class="card">
            <div class="card-header">
                <h5>Login</h5>
            </div>
            <div class="card-body">
                <form method="post" action="<?php echo base_url('User/signin');?>" id="signin_form">
                    <?php if(isset($message)) {
                        ?>
                        <div class="alert alert-danger" role="alert">
                        <?php echo $message;?>
                        </div><?
                    } ?>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-user"></i></div>
                        </div>
                        <input type="text" name="username" class="form-control" placeholder="Username" <?php if(isset($username)) echo 'value="', $username, '" ';?>/>
                    </div>
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-key"></i></div>
                        </div>
                        <input type="password" name="password" class="form-control" placeholder="Password" />
                    </div>
                    <input type="submit"/>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?><?= $this->endSection() ?>

<?php
$this->extend('default_page'); ?>
<?= $this->section('content') ?>
<div class="jumbotron">
    <form method="post" action="<?php echo base_url('/User/signup');?>" id="signup_form">
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
        <div class="input-group mb-2">
            <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-envelope"></i></div>
            </div>
            <input type="email" name="email" class="form-control" placeholder="user@example.org" <?php if(isset($email)) echo 'value="', $email, '" ';?>/>
        </div>
        <input type="submit"/>
    </form>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>
<script src="<?php base_url('js/signup.js');?>"></script>
<?= $this->endSection() ?>

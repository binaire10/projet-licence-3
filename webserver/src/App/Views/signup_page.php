<?php
$this->extend('default_page'); ?>
<?= $this->section('navbar') ?>
<?php
use App\Helpers\Misc\Navigation\NavigationBar;
$out = new \App\Helpers\PrettyPrintOutput();
$nav_bar = new NavigationBar();

$nav_bar->addLink("Connexion", '#');
$compiler = new \App\Helpers\Misc\Navigation\Bootstrap4Convert();
$nav_bar->accept($compiler);
$compiler->getRoot()->accept($out);
?>
<?= $this->endSection() ?>
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
                <div class="input-group-text">@</div>
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
<script src="js/signup.js"></script>
<?= $this->endSection() ?>

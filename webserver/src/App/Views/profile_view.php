<?php
$this->extend('default_page');
if(!isset($action, $id))
    throw new InvalidArgumentException('invalid argument')
?>
<?= $this->section('content') ?>
<div class="container">

    <div class="d-flex justify-content-center h-100 m-2">
        <div class="card">
            <?php if(isset($username)) {
                ?>
                <div class="card-header">
                    <h5><?= htmlspecialchars($username)?></h5>
                </div>
            <?php }
            ?><div class="card-body">
                <form method="post" action="<?= htmlspecialchars($action)?>" id="<?= htmlspecialchars($id)?>">
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
                        <input type="text" name="username" disabled="disabled" class="form-control" placeholder="Username" <?php if(isset($username)) echo 'value="', htmlspecialchars($username), '" ';?>/>
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

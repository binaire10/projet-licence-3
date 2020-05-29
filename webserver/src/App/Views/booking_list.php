<?php
$this->extend('default_page');

if(!isset($emprunt))
    throw new UnexpectedValueException(); ?>
<?= $this->section('content') ?>
<div class="jumbotron">
    <?php if(empty($emprunt)) {
        ?>
        <div class="container mt-2">
            <div class="row">
                <div class="col-md-12">
                    <h5>Aucun emprunt en attente</h5>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="container mt-2">
        <?php
        foreach ($emprunt as $emprunt) {
            ?>
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="media">
                        <div class="media-body">
                            <h5><?= htmlspecialchars($emprunt['titre']) ?></h5>
                            <p><?= htmlspecialchars($emprunt["nom"]) ?></p>
                            <p><?= htmlspecialchars($emprunt["identifiant"]) ?></p>
                            <p><?= htmlspecialchars($emprunt["date_demande"]) ?></p>
                            <p><?= htmlspecialchars($emprunt['id_livre']) ?></p>
                            <p><?= htmlspecialchars($emprunt['id_user']) ?></p>
                            <form method="post" action="<?php echo base_url('AcceptBorrowing/cancelBooking');?>" id="signin_form">
                                <input type="hidden" name="bookId" value="<?= htmlspecialchars($emprunt['id_livre']) ?>"/>
                                <input type="hidden" name="userId" value="<?= htmlspecialchars($emprunt['id_user']) ?>"/>
                                <button type="submit" name="action" value="cancel"/button>
                            </form>
                            <form method="post" action="<?php echo base_url('AcceptBorrowing/acceptBooking');?>" id="signin_form">
                                <input type="hidden" name="bookId" value="<?= htmlspecialchars($emprunt['id_livre']) ?>"/>
                                <input type="hidden" name="userId" value="<?= htmlspecialchars($emprunt['id_user']) ?>"/>
                                <input type="hidden" name="title" value="<?= htmlspecialchars($emprunt['titre']) ?>"/>
                                <button type="submit" name="action" value ="confirm"/button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?><?= $this->endSection() ?>


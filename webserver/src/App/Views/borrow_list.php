<?php
$this->extend('default_page');

if(!isset($emprunt))
    throw new UnexpectedValueException(); ?>
<?= $this->section('content') ?>
<div class="jumbotron">
    <?php if(isset($emprunt_found)) {
        ?>
        <div class="container mt-2">
            <div class="row">
                <div class="col-md-12">
                    <h5><?= htmlspecialchars(sizeof($emprunt_found))?></h5>
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


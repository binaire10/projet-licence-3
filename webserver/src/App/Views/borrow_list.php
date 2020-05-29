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
                    <h5>Aucun emprunt en cours</h5>
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
                            <h4>Titre :<?= htmlspecialchars($emprunt['titre']) ?></h4>
                            <p>Exemplaire n°<?= htmlspecialchars($emprunt["id_exemplaire"]) ?></p>
                            <p>Emprunteur :<?= htmlspecialchars($emprunt["nom"]) ?></p>
                            <p>Identifiant :<?= htmlspecialchars($emprunt["identifiant"]) ?></p>
                            <p>Date d'emprunt :<?= htmlspecialchars($emprunt["date_debut"]) ?></p>
                            <p>Date de retour prévu :<?= htmlspecialchars($emprunt["date_retour"]) ?></p>

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


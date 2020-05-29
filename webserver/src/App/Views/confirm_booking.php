<?php
$this->extend('default_page');

if(!isset($keys))
    throw new UnexpectedValueException();
 ?>
<?= $this->section('content') ?>
<div class="jumbotron">
    <div class="container mt-2">
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="media">
                        <div class="media-body">
                            <form method="post" action="<?php echo base_url('AcceptBorrowing/confirmBooking');?>" id="signin_form">
                                <p> ID: <?= htmlspecialchars($keys['book']) ?></p>
                                <p> Utilisateur : <?= htmlspecialchars($keys['user']) ?></p>
                                <p> Titre : <?= htmlspecialchars($keys['bookTitle']) ?></p>
                                <input type="hidden" name="bookId"  value="<?= htmlspecialchars($keys['book']) ?>"/>
                                <input type="hidden" name="userId"  value="<?= htmlspecialchars($keys['user']) ?>"/>
                                <input type="text" name="idExemplaire" />
                                <input type="date" name="bookingDate" />
                                <input type="date" name="dueDate" />
                                <button type="submit" name="action" value="confirm">Confirmer l'emprunt </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?><?= $this->endSection() ?>


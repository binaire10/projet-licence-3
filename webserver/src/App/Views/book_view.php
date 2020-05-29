<?php

use App\Views\BorrowButton;

$this->extend('default_page');
if(!isset($book))
    throw new \CodeIgniter\Exceptions\PageNotFoundException();
?>
<?= $this->section('content') ?>
<div class="jumbotron">
    <div class="card mt-2">
        <div class="card-header">
            <h5>Add new book</h5>
        </div>
        <div class="card-body">
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fas fa-book"></i></div>
                </div>
                <p class="form-control"><?= htmlspecialchars($book['titre']) ?></p>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Cote</div>
                </div>
                <p class="form-control"><?= htmlspecialchars($book['cote']) ?></p>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Summarize</div>
                </div>
                <p class="form-control"><?= htmlspecialchars($book['resumer']) ?></p>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <div class="input-group-text">Format</div>
                </div>
                <p class="form-control"><?= htmlspecialchars($book['format']) ?></p>
            </div>
        </div>
    </div>
    <div class="card mt-2">
        <div class="card-header">
            <h5>Auteur</h5>
        </div>
        <?php
        if(isset($authors)) {
            foreach ($authors as $author) {
                ?>
                <div class="card-body mt-2">
                    <div class="mt-2" id="authors">
                        <div class="input-group mb-2">
                            <p class="form-control"><?= htmlspecialchars($author['nom']) ?></p>
                        </div>
                    </div>
                </div>
                <?php
            }
        }
        ?>
    </div>
    <?php if (isset($canBeEdit) && $canBeEdit) {
        ?><a class="btn btn-primary" href="<?= base_url('Book/change/'.$book['id'])?>">Modifier</a> <?php
    } ?>
    <?php if (isset($id_user, $nb)) {
        $var = new BorrowButton($book['id'], $id_user, $nb);
    ?>
    <div name="bookButton"><?= $var->getButton() ?></div>
    <?php
        }
    ?>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?>

<?= $this->endSection() ?>

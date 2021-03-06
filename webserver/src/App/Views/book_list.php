<?php
$this->extend('default_page');

if(!isset($books))
    throw new UnexpectedValueException(); ?>
<?= $this->section('content') ?>
<div class="jumbotron">
    <?php if(isset($books_found)) {
        ?>
        <div class="container mt-2">
            <div class="row">
                <div class="col-md-12">
                    <h5><?= htmlspecialchars(sizeof($books_found))?></h5>
                </div>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="container mt-2">
        <?php
        $imageData = '//via.placeholder.com/64';
        foreach ($books as $book) {
            ?>
            <div class="row mb-2">
                <div class="col-md-12">
                    <div class="media">
                        <img src="<?= htmlspecialchars($imageData) ?>" class="img-thumbnail align-self-start mr-3"/>
                        <div class="media-body">
                            <h5><?= htmlspecialchars($book['titre']) ?></h5>
                            <p><?= htmlspecialchars($book['resumer']) ?></p>
                            <p><a href="<?= base_url('Book/watch/'.$book['id']) ?>">Voir Livre</a></p>
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


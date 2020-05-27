<?php
$this->extend('default_page');

if(!isset($books))
    throw new UnexpectedValueException(); ?>
<?= $this->section('content') ?>
<?php if(isset($books_found)) {
    ?>
    <div class="container mt-2">
        <div class="row">
            <div class="col-md-12">
                <h5><?= sizeof($books_found)?></h5>
            </div>
        </div>
    </div>
<?php
}
?>
<div class="container mt-2">
    <?php
    foreach ($books as $book) {
        $imageData = !isset($book->image, $book->image_type) ?
            '//via.placeholder.com/64'
            :
            'data:' . $book->image_type . ';base64, ' . base64_encode($book->image);
        ?>
        <div class="row">
            <div class="col-md-12">
                <div class="media">
                    <img src="<?= $imageData ?>" class="img-thumbnail align-self-start mr-3"/>
                    <div class="media-body">
                        <h5><?= $book->titre ?></h5>
                        <pre><?= $book->resumer ?></pre>
                    </div>
                </div>
            </div>
        </div>
    <?php
    }
    ?>
</div>
<?= $this->endSection() ?>
<?= $this->section('script') ?><?= $this->endSection() ?>


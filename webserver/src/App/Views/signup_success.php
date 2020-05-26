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
<h5>Success</h5>
<p>verify your email to validate your account</p>
<?= $this->endSection() ?>
<?= $this->section('script') ?><?= $this->endSection() ?>

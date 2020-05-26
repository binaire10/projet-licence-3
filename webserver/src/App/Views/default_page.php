<?php
use App\Helpers\Balise;
use \App\Helpers\BaliseBlockBuilder;
use \App\Helpers\Balise\Literal;
use App\Helpers\StringOutput;

$out = new \App\Helpers\PrintOutput();

function to_string(Balise $balise): string {
    $strigifier = new StringOutput();
    $balise->accept($strigifier);
    return $strigifier->getData();
}

$safeHeader[] = BaliseBlockBuilder::create_script(array('type'=>'text/javascript'))->addContent(
    new Literal('function jqueryFail(){document.write('.json_encode(
            to_string(BaliseBlockBuilder::create_script([
                'src'=>base_url('/js/vendor/jquery-3.3.1.min.js'),
                'integrity'=>'sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT'
            ]))
        ).');};'),
    new Literal('function jqueryUiFail(){document.write('.json_encode(
            to_string(BaliseBlockBuilder::create_script([
                'src'=>base_url('/js/vendor/jquery-ui.min.js'),
                'integrity'=>'sha384-Dziy8F2VlJQLMShA6FHWNul/veM9bCkRUaLqr199K94ntO5QUrLJBEbYegdSkkqX'
            ]))).');};'),
    new Literal('function popperFail(){document.write('.json_encode(
            to_string(BaliseBlockBuilder::create_script([
                'src'=>base_url('/js/vendor/popper.min.js'),
                'integrity'=>'sha384-pNovaElo1D1KMSDhyjlgzWzyKBFUAiE7uKtjl/kj/7ECT1PPe5YnLD5vnWbU9nvV'
            ]))).');};'),
    new Literal('function boostrapJSFail(){document.write('.json_encode(
            to_string(BaliseBlockBuilder::create_script([
                'src'=>base_url('/js/vendor/bootstrap.min.js'),
                'integrity'=>'sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl'
            ]))).');};'),
    new Literal('function boostrapCSSFail(){let link = document.createElement(\'link\');link.setAttribute(\'href\','
        .json_encode(base_url('/css/vendor/bootstrap.min.css'))
        .');link.setAttribute(\'rel\',\'stylesheet\');link.setAttribute(\'integrity\','
        .json_encode('sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm')
        .');document.head.appendChild(link);delete link;};')
);
$safeHeader[] = BaliseBlockBuilder::create_link(array(
        'onerror'=>'boostrapCSSFail()',
        'href' => '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
        'rel' => 'stylesheet', 'integrity' => 'sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm',
        'crossorigin'=>'anonymous')
);
$safeHeader[] = BaliseBlockBuilder::create_link(array(
        'onerror'=>'fontAwesomeCSSFail()',
        'href' => 'https://use.fontawesome.com/releases/v5.7.2/css/all.css',
        'rel' => 'stylesheet',
        'integrity' => 'sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr',
        'crossorigin'=>'anonymous')
);
BaliseBlockBuilder::create_link(array('href' => '/css/main.css', 'rel' => 'stylesheet'))->accept($out);
$compiler = new \App\Helpers\Misc\Navigation\Bootstrap4Convert();
\App\Views\NavBar::getInstance()->getBar()->accept($compiler);
?><!DOCTYPE html>
<html lang="fr">
<head>
<?php
    foreach ($safeHeader as $balise)
        $balise->accept($out);
    ?>
    <title><?= $title?>></title>
</head>
<body>
<?php $compiler->getRoot()->accept($out);?>
<?= $this->renderSection('content')?>
    <script onerror="jqueryFail()" src="//code.jquery.com/jquery-3.3.1.min.js" integrity="sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT" crossorigin="anonymous"></script><script onerror="jqueryUiFail()" src="//code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha384-Dziy8F2VlJQLMShA6FHWNul/veM9bCkRUaLqr199K94ntO5QUrLJBEbYegdSkkqX" crossorigin="anonymous"></script><script onerror="popperFail()" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script><script onerror="boostrapJSFail()" src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<?= $this->renderSection('script') ?>
</body>
</html>
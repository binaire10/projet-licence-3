<?php


namespace App\Helpers\Page;


use App\Helpers\Balise;
use App\Helpers\BaliseBlockBuilder;
use App\Helpers\StringOutput;

class BootstrapPage extends EmptyPage
{

    /**
     * BootstrapPage constructor.
     */
    public function __construct(array $head = [], array $body = [], array $script = [])
    {
        parent::__construct(array_merge($head, [
            BaliseBlockBuilder::create_script(array('type'=>'text/javascript'))->addContent(
                new Balise\Literal('function jqueryFail(){document.write('.json_encode(self::to_string(BaliseBlockBuilder::create_script(array('src'=>base_url('js/vendor/jquery-3.3.1.min.js'),  'integrity'=>('sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT'))))).');};'),
                new Balise\Literal('function jqueryUiFail(){document.write('.json_encode(self::to_string(BaliseBlockBuilder::create_script(array('src'=>base_url('js/vendor/jquery-ui.min.js'),  'integrity'=>('sha384-Dziy8F2VlJQLMShA6FHWNul/veM9bCkRUaLqr199K94ntO5QUrLJBEbYegdSkkqX'))))).');};'),
                new Balise\Literal('function popperFail(){document.write('.json_encode(self::to_string(BaliseBlockBuilder::create_script(array('src'=>base_url('/js/vendor/popper.min.js'),        'integrity'=>('sha384-pNovaElo1D1KMSDhyjlgzWzyKBFUAiE7uKtjl/kj/7ECT1PPe5YnLD5vnWbU9nvV'))))).');};'),
                new Balise\Literal('function boostrapJSFail(){document.write('.json_encode(self::to_string(BaliseBlockBuilder::create_script(array('src'=>base_url('/js/vendor/bootstrap.min.js'), 'integrity'=>('sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl'))))).');};'),
                new Balise\Literal('function boostrapCSSFail(){let link = document.createElement(\'link\');link.setAttribute(\'href\','
                    .json_encode('/css/vendor/bootstrap.min.css')
                    .');link.setAttribute(\'rel\',\'stylesheet\');link.setAttribute(\'integrity\','
                    .json_encode('sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm')
                    .');document.head.appendChild(link);delete link;};')
            ),
            BaliseBlockBuilder::create_link(array('onerror'=>'boostrapCSSFail()', 'href' => '//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css', 'rel' => 'stylesheet', 'integrity' => 'sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm', 'crossorigin'=>'anonymous')),
            BaliseBlockBuilder::create_link(array('onerror'=>'fontAwesomeCSSFail()', 'href' => 'https://use.fontawesome.com/releases/v5.7.2/css/all.css', 'rel' => 'stylesheet', 'integrity' => 'sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr', 'crossorigin'=>'anonymous')),
            BaliseBlockBuilder::create_link(array('href' => '/css/main.css', 'rel' => 'stylesheet'))
        ]), $body, array_merge([
            BaliseBlockBuilder::create_script(array('onerror'=>'jqueryFail()', 'src' => '//code.jquery.com/jquery-3.3.1.min.js', 'integrity'=>'sha384-tsQFqpEReu7ZLhBV2VZlAu7zcOV+rXbYlF2cqB8txI/8aZajjp4Bqd+V6D5IgvKT', 'crossorigin'=>'anonymous')),
            BaliseBlockBuilder::create_script(array('onerror'=>'jqueryUiFail()', 'src' => '//code.jquery.com/ui/1.12.1/jquery-ui.min.js', 'integrity'=>'sha384-Dziy8F2VlJQLMShA6FHWNul/veM9bCkRUaLqr199K94ntO5QUrLJBEbYegdSkkqX', 'crossorigin'=>'anonymous')),
            BaliseBlockBuilder::create_script(array('onerror'=>'popperFail()', 'src'=>'https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js', 'integrity'=>'sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q', 'crossorigin'=>'anonymous')),
            BaliseBlockBuilder::create_script(array('onerror'=>'boostrapJSFail()', 'src'=>'//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js', 'integrity'=>'sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl', 'crossorigin'=>'anonymous'))
        ], $script));
    }

    private static function to_string(Balise $balise): string {
        $strigifier = new StringOutput();
        $balise->accept($strigifier);
        return $strigifier->getData();
    }
}
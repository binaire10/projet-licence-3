<?php


namespace App\Helpers;


use App\Helpers\Balise\BlockBalise;
use App\Helpers\Balise\BlockBaliseNotEmpty;
use App\Helpers\Balise\InlineBalise;
use App\Helpers\Balise\InlineBaliseNotEmpty;
use App\Helpers\Balise\Literal;

class BaliseBlockBuilder
{
    public static function create_table(array $attr = []): BlockBalise
    {
        return new BlockBalise('table', $attr);
    }

    public static function create_thead(array $attr = []): BlockBalise
    {
        return new BlockBalise('thead', $attr);
    }

    public static function create_tbody(array $attr = []): BlockBalise
    {
        return new BlockBalise('tbody', $attr);
    }

    public static function create_th(string $texte, array $attr = []): InlineBalise
    {
        return new InlineBalise('th', $attr, array(self::create_string($texte)));
    }

    public static function create_option(string $texte, array $attr = []): InlineBalise
    {
        return new InlineBalise('option', $attr, array(self::create_string($texte)));
    }

    public static function make_option(array $attr = []): InlineBalise
    {
        return new InlineBalise('option', $attr, array());
    }

    public static function make_select(array $attr = []): BlockBalise
    {
        return new BlockBalise('select', $attr, array());
    }

    public static function create_label(string $texte, array $attr = []): InlineBaliseNotEmpty
    {
        return new InlineBaliseNotEmpty('label', $attr, array(self::create_string($texte)));
    }

    public static function create_input(array $attr = []): InlineBalise
    {
        return new InlineBalise('input', $attr);
    }

    public static function create_td(string $texte, array $attr = []): InlineBalise
    {
        return new InlineBalise('td', $attr, array(self::create_string($texte)));
    }

    public static function make_td(array $attr = []): InlineBalise
    {
        return new InlineBalise('td', $attr);
    }

    public static function make_th(array $attr = []): InlineBalise
    {
        return new InlineBalise('th', $attr);
    }

    public static function make_tr(array $attr = []): InlineBalise
    {
        return new InlineBalise('tr', $attr);
    }

    public static function create_tr(array $attr = []): BlockBalise
    {
        return new BlockBalise('tr', $attr, null);
    }

    public static function create_button(string $text, array $attr = []): InlineBalise
    {
        return new InlineBalise('button', $attr, array(self::create_string($text)));
    }

    public static function create_address(string $text, array $attr = []): InlineBaliseNotEmpty
    {
        return new InlineBaliseNotEmpty('address', $attr, array(self::create_string($text)));
    }

    public static function create_abbr(string $text, array $attr = []): InlineBaliseNotEmpty
    {
        return new InlineBaliseNotEmpty('abbr', $attr, array(self::create_string($text)));
    }

    public static function create_p(?string $text = null, array $attr = []): InlineBalise
    {
        if($text != null)
            return new InlineBalise('p', $attr, array(self::create_string($text)));
        return new InlineBalise('p', $attr);
    }

    public static function create_commentaire(string $text): Literal
    {
        return new Literal('<!-- '.htmlspecialchars($text).' -->');
    }

    public static function create_string(string $text): StringBalise
    {
        return new StringBalise($text);
    }

    public static function create_q(string $name, array $attr = []): InlineBalise
    {
        return new InlineBalise('q', $attr, array(self::create_string($name)));
    }

    public static function create_title(string $name, array $attr = []): InlineBalise
    {
        return new InlineBalise('title', $attr, array(self::create_string($name)));
    }

    public static function create_meta(array $attr = []): InlineBalise
    {
        return new InlineBalise('meta', $attr);
    }

    public static function create_link(array $attr = []): InlineBalise
    {
        return new InlineBalise('link', $attr);
    }

    public static function create_script(array $attr = []): BlockBaliseNotEmpty
    {
        return new BlockBaliseNotEmpty('script', $attr, []);
    }

    public static function create_nav(array $attr = []): BlockBalise
    {
        return new BlockBalise('nav', $attr);
    }

    public static function create_section(array $attr = []): BlockBalise
    {
        return new BlockBalise('section', $attr);
    }

    public static function make_noscript(): BlockBaliseNotEmpty
    {
        return new BlockBaliseNotEmpty('noscript');
    }

    public static function create_textArea(array $attr = []): InlineBalise
    {
        return new InlineBalise('textarea', $attr);
    }

    public static function create_form(array $attr = []): BlockBalise
    {
        return new BlockBalise('form', $attr);
    }

    public static function create_div(array $attr = []): BlockBaliseNotEmpty
    {
        return new BlockBaliseNotEmpty('div', $attr);
    }

    public static function create_a(string $name, array $attr = []): InlineBaliseNotEmpty
    {
        return new InlineBaliseNotEmpty('a', $attr, array(self::create_string($name)));
    }

    public static function create_span(string $name, array $attr = []): InlineBalise
    {
        return new InlineBalise('span', $attr, array(self::create_string($name)));
    }

    public static function create_i(string $name, array $attr = []): InlineBalise
    {
        return new InlineBalise('i', $attr, array(self::create_string($name)));
    }

    public static function make_i(array $attr = []): InlineBalise
    {
        return new InlineBalise('i', $attr);
    }

    public static function create_header(array $attr = []): BlockBalise
    {
        return new BlockBalise('header', $attr);
    }

    public static function create_article(array $attr = []): BlockBalise
    {
        return new BlockBalise('article', $attr);
    }

    public static function create_footer(array $attr = []): BlockBalise
    {
        return new BlockBalise('footer', $attr);
    }

    public static function create_li(?string $name, array $attr = []): BlockBalise
    {
        return new BlockBalise('li', $attr, array(self::create_string($name)));
    }

    public static function make_li(array $attr = []): BlockBalise
    {
        return new BlockBalise('li', $attr);
    }

    public static function create_h(int $level, string $name, array $attr = []): InlineBalise
    {
        return new InlineBalise('h'.$level, $attr, array(self::create_string($name)));
    }

    public static function create_img(array $attr = []): InlineBalise
    {
        return new InlineBalise('img', $attr);
    }

    public static function create_pre(string $texte, array $attr = []): InlineBalise
    {
        return new InlineBalise('pre', $attr, array(self::create_string($texte)));
    }

    public static function create_strong(string $texte): InlineBalise
    {
        return new InlineBalise('strong', null, array(self::create_string($texte)));
    }

    public static function make_button(array $attr = []): BlockBaliseNotEmpty
    {
        return new BlockBaliseNotEmpty('button', $attr, array());
    }

    public static function make_link(string $name, array $attr = []): InlineBalise
    {
        return new InlineBalise('a', $attr, array(self::create_string($name)));
    }

    public static function make_span(array $attr = []): InlineBalise
    {
        return new InlineBalise('span', $attr);
    }

    public static function make_h(int $level, array $attr = []): InlineBalise
    {
        return new InlineBalise('h'.$level, $attr);
    }

    public static function make_p(array $attr = []): InlineBalise
    {
        return new InlineBalise('p', $attr);
    }

    public static function create_ul(array $attr = []): BlockBalise
    {
        return new BlockBalise('ul', $attr);
    }

    public static function create_ol(array $attr = []): BlockBalise
    {
        return new BlockBalise('ol', $attr);
    }

    public static function create_lengend(string $name, array $attr = []): InlineBalise
    {
        return new InlineBalise('legend', $attr, array($name));
    }

    public static function create_fieldset(array $attr = []): BlockBalise
    {
        return new BlockBalise('fieldset', $attr);
    }

    public static function make_a($attr = null):InlineBaliseNotEmpty
    {
        return new InlineBaliseNotEmpty('a', $attr);
    }

    public static function create_head(array $attr = [], array $child = []): BlockBaliseNotEmpty
    {
        return new BlockBaliseNotEmpty('head', $attr, $child);
    }

    public static function create_body(array $attr = [], array $child = []): BlockBaliseNotEmpty
    {
        return new BlockBaliseNotEmpty('body', $attr, $child);
    }
}
<?php


namespace App\Helpers;


use App\Helpers\Balise\BlockBalise;
use App\Helpers\Balise\InlineBalise;

class BaliseBlockBuilder
{
    public static function create_table(array $tag = []): BlockBalise
    {
        return new BlockBalise('table', $tag);
    }

    public static function create_thead(array $tag = []): BlockBalise
    {
        return new BlockBalise('thead', $tag);
    }

    public static function create_tbody(array $tag = []): BlockBalise
    {
        return new BlockBalise('tbody', $tag);
    }

    public static function create_th(string $texte, array $tag = []): InlineBalise
    {
        return new InlineBalise('th', $tag, array($texte));
    }

    public static function create_option(string $texte, array $tag = []): InlineBalise
    {
        return new InlineBalise('option', $tag, array($texte));
    }

    public static function make_option(array $tag = []): InlineBalise
    {
        return new InlineBalise('option', $tag, array());
    }

    public static function make_select(array $tag = []): BlockBalise
    {
        return new BlockBalise('select', $tag, array());
    }

    public static function create_label(string $texte, array $tag = []): InlineBalise
    {
        return new InlineBalise('label', $tag, array($texte));
    }

    public static function create_input(array $tag = []): InlineBalise
    {
        return new InlineBalise('input', $tag);
    }

    public static function create_td(string $texte, array $tag = []): InlineBalise
    {
        return new InlineBalise('td', $tag, array($texte));
    }

    public static function make_td(array $tag = []): InlineBalise
    {
        return new InlineBalise('td', $tag);
    }

    public static function make_th(array $tag = []): InlineBalise
    {
        return new InlineBalise('th', $tag);
    }

    public static function make_tr(array $tag = []): InlineBalise
    {
        return new InlineBalise('tr', $tag);
    }

    public static function create_tr(array $tag = []): BlockBalise
    {
        return new BlockBalise('tr', $tag, null);
    }

    public static function create_button(string $text, array $tag = []): InlineBalise
    {
        return new InlineBalise('button', $tag, array($text));
    }

    public static function create_address(string $text, array $tag = []): InlineBalise
    {
        return new InlineBalise('address', $tag, array($text));
    }

    public static function create_abbr(string $text, array $tag = []): InlineBalise
    {
        return new InlineBalise('abbr', $tag, array($text));
    }

    public static function create_p(?string $text = null, array $tag = []): InlineBalise
    {
        if($text != null)
            return new InlineBalise('p', $tag, array($text));
        return new InlineBalise('p', $tag);
    }

    public static function create_commentaire(string $text): Literal
    {
        return new Literal('<!-- '.htmlspecialchars($text).' -->');
    }

    public static function create_string(string $text): StringBalise
    {
        return new StringBalise($text);
    }

    public static function create_q(string $name, array $tag = []): InlineBalise
    {
        return new InlineBalise('q', $tag, array($name));
    }

    public static function create_title(string $name, array $tag = []): InlineBalise
    {
        return new InlineBalise('title', $tag, array(self::create_string($name)));
    }

    public static function create_meta(array $tag = []): InlineBalise
    {
        return new InlineBalise('meta', $tag);
    }

    public static function create_link(array $tag = []): InlineBalise
    {
        return new InlineBalise('link', $tag);
    }

    public static function create_script(array $tag = []): BlockBalise
    {
        return new BlockBalise('script', $tag);
    }

    public static function create_nav(array $tag = []): BlockBalise
    {
        return new BlockBalise('nav', $tag);
    }

    public static function create_section(array $tag = []): BlockBalise
    {
        return new BlockBalise('section', $tag);
    }

    public static function make_noscript(): BlockBalise
    {
        return new BlockBalise('noscript');
    }

    public static function create_textArea(array $tag = []): InlineBalise
    {
        return new InlineBalise('textarea', $tag);
    }

    public static function create_form(array $tag = []): BlockBalise
    {
        return new BlockBalise('form', $tag);
    }

    public static function create_div(array $tag = []): BlockBalise
    {
        return new BlockBalise('div', $tag);
    }

    public static function create_a(string $name, array $tag = []): InlineBalise
    {
        return new InlineBalise('a', $tag, array($name));
    }

    public static function create_span(string $name, array $tag = []): InlineBalise
    {
        return new InlineBalise('span', $tag, array($name));
    }

    public static function create_i(string $name, array $tag = []): InlineBalise
    {
        return new InlineBalise('i', $tag, array($name));
    }

    public static function make_i(array $tag = []): InlineBalise
    {
        return new InlineBalise('i', $tag);
    }

    public static function create_header(array $tag = []): BlockBalise
    {
        return new BlockBalise('header', $tag);
    }

    public static function create_article(array $tag = []): BlockBalise
    {
        return new BlockBalise('article', $tag);
    }

    public static function create_footer(array $tag = []): BlockBalise
    {
        return new BlockBalise('footer', $tag);
    }

    public static function create_li(?string $name, array $tag = []): BlockBalise
    {
        return new BlockBalise('li', $tag, array($name));
    }

    public static function make_li(array $tag = []): BlockBalise
    {
        return new BlockBalise('li', $tag);
    }

    public static function create_h(int $level, string $name, array $tag = []): InlineBalise
    {
        return new InlineBalise('h'.$level, $tag, array($name));
    }

    public static function create_img(array $tag = []): InlineBalise
    {
        return new InlineBalise('img', $tag);
    }

    public static function create_pre(string $texte, array $tag = []): InlineBalise
    {
        return new InlineBalise('pre', $tag, array($texte));
    }

    public static function create_strong(string $texte): InlineBalise
    {
        return new InlineBalise('strong', null, array($texte));
    }

    public static function make_button(array $tag = []): InlineBalise
    {
        return new InlineBalise('button', $tag, array());
    }

    public static function make_link(string $name, array $tag = []): InlineBalise
    {
        return new InlineBalise('a', $tag, array($name));
    }

    public static function make_span(array $tag = []): InlineBalise
    {
        return new InlineBalise('span', $tag);
    }

    public static function make_h(int $level, array $tag = []): InlineBalise
    {
        return new InlineBalise('h'.$level, $tag);
    }

    public static function make_p(array $tag = []): InlineBalise
    {
        return new InlineBalise('p', $tag);
    }

    public static function create_ul(array $tag = []): BlockBalise
    {
        return new BlockBalise('ul', $tag);
    }

    public static function create_ol(array $tag = []): BlockBalise
    {
        return new BlockBalise('ol', $tag);
    }

    public static function create_lengend(string $name, array $tag = []): InlineBalise
    {
        return new InlineBalise('legend', $tag, array($name));
    }

    public static function create_fieldset(array $tag = []): BlockBalise
    {
        return new BlockBalise('fieldset', $tag);
    }

    public static function make_a($tag = null)
    {
        return new InlineBalise('a', $tag);
    }

    public static function create_head(array $tag = [], array $child = [])
    {
        return new BlockBalise('head', $tag, $child);
    }

    public static function create_body(array $tag = [], array $child = [])
    {
        return new BlockBalise('body', $tag, $child);
    }
}
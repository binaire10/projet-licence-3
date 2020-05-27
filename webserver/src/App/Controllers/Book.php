<?php


namespace App\Controllers;


class Book extends BaseController
{
    public function index() {
        $books = [];
        $books[] = $book = new \stdClass();
        $book->titre = 'magic';
        $book->resumer = '..................';
        return view('book_list', [
            'title' => 'Book list',
            'books' => $books
        ]);
    }
    public function add() {
        $authors = $this->request->getPost('authors');
        $title = $this->request->getPost('book_title');
        $cote = $this->request->getPost('book_cote');
        $book_summarize = $this->request->getPost('book_summarize');
        $book_format = $this->request->getPost('book_format');
        if(isset($title, $cote, $authors, $book_format, $book_summarize)) {
            $db = \Config\Database::connect();
            $tableBook = $db->table('Livre');
            $tableBook->insert([
                'cote' => $cote,
                'titre' =>  $title,
                'resumer' => $book_summarize,
                'format' => $book_format
            ]);
            $bookId = $db->insertID();
            foreach ($authors as $author) {
                $tableAuthor = $db->table('A_ECRIT');
                $tableAuthor->insert([
                    'id_auteur' => $author,
                    'id_livre' => $bookId
                ]);
            }
        }
        if(isset($authors)) {
            $db = \Config\Database::connect();
            $tableAuthor = $db->table('Auteur');
            $authors = $tableAuthor->select('*')->whereIn('id', $authors)->get()->getResultArray();
        }
        return view('book_new', [
            'title' => 'Add book new',
            'book_format' => $book_format,
            'book_summarize' => $book_summarize,
            'book_cote' => $cote,
            'book_title' => $title,
            'authors' => $authors,
        ]);
    }
}
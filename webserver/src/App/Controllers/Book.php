<?php


namespace App\Controllers;


use CodeIgniter\Exceptions\PageNotFoundException;

class Book extends BaseController
{
    public function index() {
        $db = \Config\Database::connect();
        return view('book_list', [
            'title' => 'Book list',
            'books' => $db->table('Livre')->select('*')->get()->getResultArray()
        ]);
    }

    public function watch(int $id) {
        $db = \Config\Database::connect();
        $book = $db->table('Livre')->select('*')->where('id', $id)->get()->getResultArray();
        if(empty($book))
            throw new PageNotFoundException();
        return view('book_view', [
            'title' => $book[0]['titre'],
            'book' => $book[0],
            'authors' => $db->table('Auteur')->select('*')->join('A_ECRIT', 'Auteur.id = A_ECRIT.id_auteur')->where('A_ECRIT.id_livre', $id)->get()->getResultArray()
        ]);
    }

    public function add() {
        if(!$this->isLibrarian)
            throw new PageNotFoundException();
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
            header('Location: '.base_url(''));
            die;
        }
        if(isset($authors)) {
            $db = \Config\Database::connect();
            $tableAuthor = $db->table('Auteur');
            $authors = $tableAuthor->select('*')
                ->whereIn('id', $authors)
                ->get()->getResultArray();
        }
        return view('book_new', [
            'title' => 'Add book new',
            'book_format' => $book_format,
            'book_summarize' => $book_summarize,
            'book_cote' => $cote,
            'book_title' => $title,
            'url_form' => base_url('Book/add'),
            'authors' => $authors,
        ]);
    }
}
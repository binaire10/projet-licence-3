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
        $id_user = $this->session->get('user');

        $nb_available = $this->nb_available($id, $id_user);
        if($this->is_reserved($id, $id_user)) {
            $nb_available = -1;
        }
        if(empty($book))
            throw new PageNotFoundException();
        return view('book_view', [
            'title' => $book[0]['titre'],
            'book' => $book[0],
            'canBeEdit' => $this->isLibrarian,
            'nb' => $nb_available,
            'id_user' => $id_user,
            'authors' => $db->table('Auteur')->select('*')->join('A_ECRIT', 'Auteur.id = A_ECRIT.id_auteur')->where('A_ECRIT.id_livre', $id)->get()->getResultArray()
        ]);
    }

    public function change(int $id) {
        if(!$this->isLibrarian)
            throw new PageNotFoundException();
        $change = $this->request->getPost('change');
        $data_achat = $this->request->getPost('exemplaires_date_achat');
        $idExemplaire = $this->request->getPost('exemplaires_id');
        $idRemove = $this->request->getPost('remove');

        $book_title = $this->request->getPost('book_title');
        $book_cote = $this->request->getPost('book_cote');
        $book_summarize = $this->request->getPost('book_summarize');
        $book_format = $this->request->getPost('book_format');

        $authors = $this->request->getPost('authors');

        $db = \Config\Database::connect();
        if(isset($change)) {
            $exemplaireDb = $db->table('Exemplaire');

            if (isset($idRemove)) {
                foreach ($idRemove as $item)
                    $exemplaireDb->delete(['id' => $item, 'id_livre' => $id]);
            }
            if (isset($data_achat, $idExemplaire)) {
                foreach ($data_achat as $index => $value)
                    $exemplaireDb->insert(['id' => $idExemplaire[$index], 'id_livre' => $id, 'date_achat' => $value]);
            }
            if (isset($book_title, $book_cote, $book_summarize, $book_format))
                $db->table('Livre')->update([
                    'cote' => $book_cote,
                    'titre' => $book_title,
                    'resumer' => $book_summarize,
                    'format' => $book_format
                ], ['id' => $id]);
                $db->table('A_ECRIT')->delete(['id_livre' => $id]);
            if (isset($authors)) {
                foreach ($authors as $author)
                    $db->table('A_ECRIT')->insert(['id_livre' => $id, 'id_auteur' => $author]);
            }
        }
        $book = $db->table('Livre')->select('*')->where('id', $id)->get()->getResultArray();
        if(empty($book))
            throw new PageNotFoundException();
        return view('book_change', [
            'title' => $book[0]['titre'],
            'book' => $book[0],
            'authors' => $db->table('Auteur')->select('*')->join('A_ECRIT', 'Auteur.id = A_ECRIT.id_auteur')->where('A_ECRIT.id_livre', $id)->get()->getResultArray(),
            'exemplaires' => $db->table('Exemplaire')->select('*')->where('id_livre', $id)->get()->getResultArray()
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

    public function nb_available($id, $id_user) {
        $db = \Config\Database::connect();

        //ligne inspirée par https://stackoverflow.com/questions/2686254/how-to-select-all-records-from-one-table-that-do-not-exist-in-another-table
        return count($db->table('Exemplaire')->select('Exemplaire.id')->join('EmpruntCourant', 'EmpruntCourant.id_exemplaire = Exemplaire.id', 'left')->where('EmpruntCourant.id_exemplaire', null)->get()->getResultArray());
    }

    public function book($id_livre, $id_user) {
        $db = \Config\Database::connect();
        if(!$this->isUser)
            throw new PageNotFoundException();

        if($this->is_reserved($id_livre, $id_user))
            throw new PageNotFoundException();

        $db->table('Reservation')->insert(['id_livre' => $id_livre, 'id_user' => $id_user, 'date_demande' => date("Y-m-d H:i:s")]);
    }

    public function nb_empruntes($id_user) {
        $db = \Config\Database::connect();
        //TODO:nombre de livres empruntes
        return 0;
    }

    public function is_reserved($id, $id_user) {
        $db = \Config\Database::connect();
        return count($db->table('Reservation')->select('*')->where('Reservation.id_livre', $id)->where('Reservation.id_user',$id_user)->get()->getResultArray()) > 0;
    }
}
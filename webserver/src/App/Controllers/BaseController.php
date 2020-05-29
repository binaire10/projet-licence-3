<?php
namespace App\Controllers;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 *
 * @package CodeIgniter
 */

use App\Helpers\BaliseBlockBuilder;
use App\Views\NavBar;
use CodeIgniter\Controller;

class BaseController extends Controller
{

	/**
	 * An array of helpers to be loaded automatically upon
	 * class instantiation. These helpers will be available
	 * to all other controllers that extend BaseController.
	 *
	 * @var array
	 */
	protected $helpers = [];
	protected \CodeIgniter\Session\Session $session;
	protected bool $isUser;
	protected bool $isLibrarian;

	/**
	 * Constructor.
	 */
	public function initController(\CodeIgniter\HTTP\RequestInterface $request, \CodeIgniter\HTTP\ResponseInterface $response, \Psr\Log\LoggerInterface $logger)
	{
		// Do Not Edit This Line
		parent::initController($request, $response, $logger);

		//--------------------------------------------------------------------
		// Preload any models, libraries, etc, here.
		//--------------------------------------------------------------------
		// E.g.:
		 $this->session = \Config\Services::session();

        if($this->session->has('user')) {
            $db = \Config\Database::connect();
            $this->bUser = $db->table('Bibliothecaire')->select('*')->where('id', $this->session->get('user'))->get()->getResultArray();
            $this->isUser = true;
            $this->isLibrarian = !empty($this->bUser);
        }
        else {
            $this->isUser = false;
            $this->isLibrarian = false;
        }

		 if(!$this->request->isAJAX())
		     self::init_web();
	}

	protected function init_web() {
        if($this->isUser) {
            $nav_bar = NavBar::getInstance()->getBar();
            $nav_bar->addOutsideBalise(
                BaliseBlockBuilder::create_ul([
                    'class' => 'nav navbar-nav navbar-right'
                ])->addContent(
                    BaliseBlockBuilder::make_li()->addContent(
                        BaliseBlockBuilder::create_form([
                            'action' => base_url('User/signout')
                        ])->addContent(
                            BaliseBlockBuilder::make_button([
                                'class' => 'btn btn-link nav-link'
                            ])->addContent(
                                BaliseBlockBuilder::make_i([
                                    'class' => 'fa fa-sign-out-alt',
//                                    'aria-hidden' => 'true'
                                ])
                            )
                        )
                    )
                )
            );
            $account_item = $nav_bar->addMenu('Compte');
            $account_item->addLink('Profile', base_url('User/profile'));
        }
        else {
            $nav_bar = NavBar::getInstance()->getBar();
            $nav_bar->addLink("Connexion", base_url('User/signin'));
            $nav_bar->addLink("Inscription", base_url('User/signup'));
        }

        if($this->isLibrarian) {
            $bookMenu = $nav_bar->addMenu('Livre');
            $bookMenu->addLink('List', base_url('Book'));
            $gestionMenu = $nav_bar->addMenu('Gestion de bibliothèque');
            $gestionMenu->addLink('Ajout livre', base_url('Book/add'));
            $gestionMenu->addLink('Ajout auteur', base_url('Author/add'));
            $gestionMenu->addLink('Validate adhérents', base_url('Adherents/futursAdherents'));
            $gestionMenu->addLink('Liste d\'emprunts', base_url('Emprunt'));
            $gestionMenu->addLink('Emprunts en attente', base_url('AcceptBorrowing/listBooking'));
        }
        else {
            $bookMenu = $nav_bar->addMenu('Book');
            $bookMenu->addLink('List', base_url('Book'));
        }
    }
}

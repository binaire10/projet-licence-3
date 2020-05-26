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
            NavBar::getInstance()->getBar()->addOutsideBalise(
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
        }
        else {

        }
	}

}

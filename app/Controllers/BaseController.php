<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use App\Models\HomeModel;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;
    protected $validation;

    //SEO
    protected $seo_image;
    protected $seo_description;
    protected $sitename;

    protected $homeModel;


    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = ['url', 'form', 'session', 'security'];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);
        $this->validation = \Config\Services::validation();

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
        date_default_timezone_set('Africa/Kampala');
        $this->seo_image = base_url() . "/public/assets/images/logo.jpg";
        $this->seo_description = 'Nile Bridge Hotel, Best Hotel in Uganda, Along the Nile.';
        $this->sitename = 'Nile Bridge Hotel';

        $this->homeModel = new HomeModel();

    }

    
}

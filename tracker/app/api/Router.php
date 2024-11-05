<?php
namespace App\Api;
use App\Base\Request;
use App\Base\Route;
use App\Base\View;
use App\Controllers\AdminController;
use App\Controllers\ContactController;
class Router extends Route
{
    public function __construct()
    {
        parent::__construct();
    }

    public function run()
    {
        $this->get('/', function() {
            // load the home page frontend/index.php
            return View::render('index.php');
        });
        $this->get('/api/contact/store', [ContactController::class , 'store']);
        $this->get('/api/domains', ['ApiController@getDomains']);

        parent::init();
    }
}
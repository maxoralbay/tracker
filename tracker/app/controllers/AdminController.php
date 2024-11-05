<?php

namespace App\Controllers;
use App\Base\Request;
use App\models\ContactModel;
use App\Base\View;
class AdminController
{
    public function __construct()
    {
       // $this->model = new ContactModel();

    }
    public function index(Request $request)
    {
        return View::render('dist/index.html');
    }
}
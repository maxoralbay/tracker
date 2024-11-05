<?php

namespace App\controllers;
use App\Base\Request;
use App\models\ContactModel;
class DomainsController
{
    public function __construct()
    {
       // $this->model = new ContactModel();

    }
    public function store(Request $request)
    {
        print_r(['request' => $request->all()]);
        echo 'Contact store';
    }
}
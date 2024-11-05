<?php

namespace App;

use App\Api\Router;

class App
{
    // contact
    // domain
    // user
    // visit
    // init controller
    public function __construct()
    {
    }

    public function run()
    {
        $router = new Router();
        $router->run();
    }


}


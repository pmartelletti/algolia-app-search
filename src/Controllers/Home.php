<?php

namespace App\Controllers;

use App\Framework\Http\Response;

class Home extends Controller
{
    public function index()
    {
//        return new Response('Hello Pablo, this looks pretty good!!');
        return $this->renderTemplate('index', [
            'algolia_app_id' => getenv('ALGOLIA_APP_ID')
        ]);
    }
}
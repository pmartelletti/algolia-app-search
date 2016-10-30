<?php

namespace App\Controllers;


use Symfony\Component\HttpFoundation\Response;

class Home extends Controller
{
    public function index()
    {
        return new Response('Hello Pablo, this looks pretty good!!');
    }
}
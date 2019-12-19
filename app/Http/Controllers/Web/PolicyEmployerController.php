<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;

class PolicyEmployerController extends Controller
{

    public function index()
    {
        return view('web.policy.employer');
    }
}
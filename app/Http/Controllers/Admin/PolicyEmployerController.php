<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;

class PolicyEmployerController extends Controller
{

    public function index()
    {
       return view('admin.policy.employer.index');
    }
}
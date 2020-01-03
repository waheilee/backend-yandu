<?php

namespace App\Http\Controllers\Wap;


use App\Http\Controllers\Controller;

class WorkerInfoController extends Controller
{

    public function index()
    {
        return view('wap.worker_info.index');
    }
}
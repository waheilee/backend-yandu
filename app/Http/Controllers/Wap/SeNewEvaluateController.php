<?php

namespace App\Http\Controllers\Wap;


use Illuminate\Http\Request;

class SeNewEvaluateController
{

    public function index()
    {
        return view('wap.se_new.evaluate.index');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }
}
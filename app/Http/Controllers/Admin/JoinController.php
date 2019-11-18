<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\Admin\JoinService;
use Illuminate\Http\Request;

class JoinController extends Controller
{
    protected $joinService;

    public function __construct(JoinService $joinService)
    {
        $this->joinService = $joinService;
    }

    public function index()
    {
        return view('admin.join.index');
    }

    public function indexRequest(Request $request)
    {
        $data =$this->joinService->indexAjax($request);
        return $data;
    }
}
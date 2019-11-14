<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\Admin\DemandService;

use Illuminate\Http\Request;

class DemandController extends Controller
{

    protected $demandService;

    public function __construct(DemandService $demandService)
    {
        $this->demandService = $demandService;
    }
    public function index()
    {
        return view('admin.demand.index');
    }

    public function indexRequest(Request $request)
    {
        $data =$this->demandService->indexAjax($request);
        return $data;
    }
}
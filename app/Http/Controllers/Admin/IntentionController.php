<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Services\Admin\IntentionService;
use Illuminate\Http\Request;

class IntentionController extends Controller
{

    protected $intentionService;

    public function __construct(IntentionService $intentionService)
    {
        $this->intentionService = $intentionService;
    }

    public function index()
    {
        return view('admin.intention.index');
    }

    public function indexRequest(Request $request)
    {
        $data =$this->intentionService->indexAjax($request);
        return $data;
    }

    public function partner(Request $request)
    {
       $data = $this->intentionService->getPartner($request);
       return $data;
    }

    public function check(Request $request)
    {
        $data =$this->intentionService->checkStore($request);
        return $data;
    }
}
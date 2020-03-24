<?php

namespace App\Http\Controllers\Admin;


use App\Services\Admin\AirService;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class AirController
{

    protected $airService;

    public function __construct(AirService $airService)
    {
        $this->airService = $airService;
    }

    public function index()
    {
        return view('admin.air.index');
    }

    public function indexRequest(Request $request)
    {
        $data =$this->airService->indexAjax($request);
        return $data;
    }

    public function qrcode()
    {
       $scan =  base64_encode(QrCode::format('png')->size(350)->generate(url('air/form/'.auth()->id())));
      return $scan;
    }
}
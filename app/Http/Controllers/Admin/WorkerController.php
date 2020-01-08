<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\Worker;
use App\Services\Admin\WorkerService;
use Illuminate\Http\Request;
use App\Requests\Admin\WorkerRequest;


class WorkerController extends Controller
{
    protected $workerService;

    public function __construct(WorkerService $workerService)
    {
        $this->workerService = $workerService;
    }

    public function index()
    {
        return view('admin.worker.index');
    }

    public function indexRequest(Request $request)
    {
        $data =$this->workerService->indexAjax($request);
        return $data;
    }

    public function create()
    {
        return view('admin.worker.create');

    }

    public function store(WorkerRequest $request)
    {
        $data = $this->workerService->getStore($request);
        return $data;
    }



    public function image(Request $request)
    {
        $data = $this->workerService->handle($request);
        return $data;
    }

    public function imgQrcode(Request $request)
    {
        $id = $request->input('id');
        $worker = Worker::whereId($id)->first();
        return response()->json(['img'=>asset($worker->qrcode)]);
    }
}
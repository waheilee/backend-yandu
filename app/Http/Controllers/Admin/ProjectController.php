<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Models\ProjectOrder;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin.project.index');
    }

    public function store(Request $request)
    {
        if ($request->isMethod('get')){
            return view('admin.project.create');
        }else{
            try{
//                dd($request->all());
                $proModel = new ProjectOrder();
                $proModel->num = time();
                $proModel->merchant_id = auth()->id();
                $proModel->project_name = $request->input('project_name');
                $proModel->address      = $request->input('address');
                $proModel->begin_time   = $request->input('begin_time');
                $proModel->end_time     = $request->input('end_time');
                $proModel->size         = $request->input('size');
                $proModel->cash_deposit = $request->input('cash_deposit');
                $proModel->budget       = $request->input('budget');
                $proModel->people_num    = $request->input('people_num');
                $proModel->phone    = $request->input('phone');
                $proModel->project_time  = '三周';
                $proModel->content      = $request->input('content');
                $proModel->save();

            }catch (\Exception $exception){
                throw $exception;
            }
        }
    }
}
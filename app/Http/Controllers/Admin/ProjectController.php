<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Requests\ProjectRequest;
use App\Services\ProjectService;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    protected $projectService;

    public function __construct(ProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function index()
    {
        return view('admin.project.index');
    }

    public function indexRequest(Request $request)
    {
        $data =$this->projectService->indexAjax($request);
        return $data;
    }

    public function store(ProjectRequest $request)
    {
        if ($request->isMethod('get')){
            return view('admin.project.create');
        }else{
            try{
//                dd($request->all());
               $data = $this->projectService->createProject($request);
               if ($data){
                   $result['status'] = true;
                   $result['message'] = '项目发布成功';
                   return response()->json($result);
               }
            }catch (\Exception $exception){
                throw $exception;
            }
        }
    }
}
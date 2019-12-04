<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Requests\Admin\ProjectRequest;
use App\Services\Admin\ProjectService;
use Illuminate\Http\Request;
use App\Models\Project;
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

    public function create()
    {
        return view('admin.project.create');
    }

    public function store(ProjectRequest $request)
    {
        try{
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



    public function edit(Request $request)
    {
        $model = Project::whereId($request->input('id'))->first();
        return view('admin.project.edit',compact('model'));

    }

    public function update(ProjectRequest $request)
    {
        try{
            $data = $this->projectService->updateProject($request);
            if ($data){
                $result['status'] = true;
                $result['message'] = '项目修改成功';
                return response()->json($result);
            }
        }catch (\Exception $exception){
            throw $exception;
        }
    }

    public function delete(Request $request)
    {
        $id = $request->input('id');
        $model = Project::whereId($id)->first();
        $model->delete();
        return response()->json(['message'=>'删除成功']);
    }
}
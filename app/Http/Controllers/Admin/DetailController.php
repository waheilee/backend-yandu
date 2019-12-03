<?php

namespace App\Http\Controllers\Admin;


use App\Models\News;
use App\Models\Service;
use Illuminate\Http\Request;

class DetailController
{

    public function newsDetail(Request $request)
    {
        $id = $request->input('id');
        $row = News::whereId( $id)->first(['id', 'title', 'content', 'created_at', 'modify_time', 'summary', 'seo']);
//        News::where('id', $id)->increment('views');
//        return $this->json($row);
        return view('admin.detail.index',compact('row'));
    }

    public function serviceDetail(Request $request)
    {
        $id = $request->input('id');
        $row = Service::find($id);
        return view('admin.detail.index',compact('row'));
    }
}
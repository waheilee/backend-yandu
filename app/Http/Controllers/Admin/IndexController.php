<?php

namespace App\Http\Controllers\Admin;


use App\Models\Merchant;
use App\Models\News;
use App\Models\Policy;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class IndexController
{
    public function index()
    {
        $row = Merchant::where('id', \Auth::user()->id)->first(['page_views', 'contact_views', 'policy_num']);
        $projects = Policy::where('merchant_id', \Auth::user()->id)->count();
        $policy = Policy::where('merchant_id', \Auth::user()->id)->sum('policy_total');

        $remains = $row->policy_num - $policy;
        $service = Service::all(['id', 'name']);
        $filter = 'news';
        $news = News::paginate();
//        foreach ($results as $key => $row) {
//            $results[$key]->cover = Storage::url($row->cover);
//        }
        return view('admin.index.index',[
            'page_views' => $row->page_views,
            'contact_views' => $row->contact_views,
            'projects' => $projects,
            'policy' => $remains > 0 ? $remains : 0,
            'service' =>$service,
            'news' =>$news
        ]);
    }


}
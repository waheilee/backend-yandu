<?php

namespace App\Services\Admin;


use App\Models\MemberPolicy;
use Illuminate\Http\Request;

class PolicyShowService
{
    /**
     * @param Request $request
     * @return mixed
     */
    public function showList(Request $request)
    {

        $limit    = $request->input('limit');
        $policyId = $request->input('id');
        $rows = MemberPolicy::wherePolicyId( $policyId)->orderBy('created_at', 'desc')->paginate($limit);
        foreach ($rows as $item){
            $url = json_encode(asset($item['policy_img']));
            $item['button'] = "<button type=\"button\" class=\"btn btn-info btn-sm\" onclick='show_policy_img($url)'>查看保单</button>";
        }
        $array['page']  = $rows->currentPage();
        $array['rows']  = $rows->items();
        $array['total'] = $rows->total();
        return $array;

    }
}
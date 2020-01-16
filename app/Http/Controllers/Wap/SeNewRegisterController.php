<?php

namespace App\Http\Controllers\Wap;


use App\Http\Controllers\Controller;
use App\Models\Worker;
use App\Requests\Wap\SeNewRegisterRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Ofcold\IdentityCard\IdentityCard;
use Illuminate\Auth\Events\Registered;

class SeNewRegisterController extends Controller
{

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = 'm/se_new/worker_center';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
        return view('wap.se_new.login.register');
    }

    /**
     * @param SeNewRegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
//    public function register(SeNewRegisterRequest $request)
//    {
//
//        $cardNum = $request->input('id_card');
//        $phone = $request->input('phone');
//        $workerPhone = Worker::wherePhone($phone)->first();
//        if ($workerPhone){
//            return response()->json(['errors' =>['phone'=>[0=>'该电话已被注册']]], 422);
//        }
//        $workerIdCard = Worker::whereCardNum($cardNum)->first();
//        if ($workerIdCard){
//            return response()->json(['errors' =>['idcard'=>[0=>'改证件已被注册']]], 422);
//        }
//        $card = IdentityCard::make($cardNum);
//        if ($card === false) {
//            return response()->json(['errors' =>['idcard'=>[0=>'证件号码不正确']]], 422);
//        }
//        event(new Registered($user = $this->create($request->all())));
//        $user = $this->create($request->all());
//        $this->guard()->login($user);
//        dd($this->guard()->login($user));
//        return redirect($this->redirectTo);
//    }


    /**
     * @param array $data
     * @return Worker|\Illuminate\Database\Eloquent\Model
     */
    protected function create(array $data)
    {
        $arr = explode(" ",$data['address']);
        return Worker::create([
            'card_a' => '-',
            'card_b' => '-',
            'age' => 0,
            'sex' => 0,
            'tec' => 0,
            'work_age' => 0,
            'avatar' => '',
            'name' =>  $data['name'],
            'phone' => $data['phone'],
            'card_num' => $data['id_card'],
            'province' => $arr[0],
            'city' => $arr[1],
            'county' => $arr[2],
            'password' => Hash::make(substr($data['phone'],-6)),
            'channel' => 'senew',
            'is_active' => 0,
        ]);
    }


    /**
     * @param SeNewRegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(SeNewRegisterRequest $request)
    {
        $cardNum = $request->input('id_card');
        $phone = $request->input('phone');
        $workerPhone = Worker::wherePhone($phone)->whereChannel('senew')->first();
        if ($workerPhone){
            return response()->json(['errors' =>['phone'=>[0=>'该电话已被注册']]], 422);
        }
        $workerIdCard = Worker::whereCardNum($cardNum)->whereChannel('senew')->first();
        if ($workerIdCard){
            return response()->json(['errors' =>['idcard'=>[0=>'改证件已被注册']]], 422);
        }
        $card = IdentityCard::make($cardNum);
        if ($card === false) {
            return response()->json(['errors' =>['idcard'=>[0=>'证件号码不正确']]], 422);
        }
        event(new Registered($user = $this->create($request->all())));
        return response()->json(['注册成功']);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('work');
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        //
    }

    /**
     * Get the post register / login redirect path.
     *
     * @return string
     */
    public function redirectPath()
    {
        if (method_exists($this, 'redirectTo')) {
            return $this->redirectTo();
        }

        return property_exists($this, 'redirectTo') ? $this->redirectTo : 'm/se_new/worker_center';
    }
}
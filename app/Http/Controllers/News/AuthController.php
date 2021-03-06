<?php

namespace App\Http\Controllers\News;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;    
use App\Http\Requests\AuthLoginRequest as MainRequest;
use App\Models\UserModel;

class AuthController extends Controller
{
    private $pathViewController = 'news.pages.auth.';  // slider
    private $controllerName     = 'auth';
    private $params             = [];
    private $model;

    public function __construct()
    {
        view()->share('controllerName', $this->controllerName);
    }

    //======== LOGIN =========
    public function login(Request $request)
    {   
        return view($this->pathViewController . 'login');
    }

    //======== POST LOGIN =========
    public function postLogin(MainRequest $request)
    {   
        if ($request->method() == 'POST') {
            $params = $request->all();

            $userModel = new UserModel();
            $userInfo = $userModel->getItem($params, ['task' => 'auth-login']);
           
            if (!$userInfo)
                return redirect()->route($this->controllerName . '/login')->with('news_notify', 'Incorrect account or password!');

            $request->session()->put('userInfo', $userInfo);
            return redirect()->route('home');
        }
    }

    //======== LOGOUT =========
    public function logout(Request $request)
    {   
        if($request->session()->has('userInfo')) $request->session()->pull('userInfo');
        return redirect()->route('home');
    }

    //======== REGISTER =========
    public function register(Request $request)
    {   
      
        return view($this->pathViewController . 'register');
    }

 
}
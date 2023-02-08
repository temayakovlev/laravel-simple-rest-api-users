<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Controllers\BaseController;

class UserAuthController extends BaseController {
    /** 
     * Авторизация пользователя
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(Request $request) { 
        $validate = $this->validateUserData($request->all(), 'login');
        if ($validate->fails()) {
            return $this->sendFail($validate->errors(), '');
        };

        $user_email = $request->email;
        $user_password = $request->password;
        if (!(Auth::attempt(['email' => $user_email, 'password' => $user_password]))) {
            return $this->sendFail('Unauthorized', '');
        };
        
        $auth = Auth::user(); 
        $data['user_token'] = $auth->createToken('UserAuth')->accessToken; 

        return $this->sendSuccess($data, '');
    }
    
    /** 
     * Регистрация пользователя
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) { 
        $validate = $this->validateUserData($request->all(), 'register');
        if ($validate->fails()) {
            return $this->sendFail($validate->errors(), '');
        };

        $user_data = $request->all(); 
        $user_data['password'] = bcrypt($user_data['password']); 

        $user = User::create($user_data);
        $data['user_token'] = $user->createToken('UserRegister')->accessToken;
        
        return $this->sendSuccess($data, '');
    }
};
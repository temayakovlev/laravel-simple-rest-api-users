<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;

class BaseController extends Controller {
    /** 
     * Валидация пользовательских данных
     * 
     * @return object
     */ 
    public function validateUserData($data, $type) {
        $rules = [
            'id' => 'bail|required|numeric|max:999999',
            'name' => 'bail|required|max:255',
            'email' => 'bail|required|email|max:255',
            'password' => 'bail|required|max:255'
        ];

        switch ($type) {
            case 'register':
                $rul = [
                    'name' => $rules['name'],
                    'email' => $rules['email'] . '|unique:users',
                    'password' => $rules['password']
                ];
                break;
            case 'login':
                $rul = [
                    'email' => $rules['email'],
                    'password' => $rules['password']
                ];
                break;
            case 'userData':
                $rul = [
                    'name' => $rules['name'],
                    'email' => $rules['email']
                ];
                break;
            case 'userID':
                $rul = [
                    'id' => $rules['id']
                ];
                break;
        };

        return Validator::make($data, $rul);
    }

    /** 
     * Вывод ответа (успешно)
     * 
     * @return \Illuminate\Http\Response 
     */
    public function sendSuccess($result, $message) {
    	$response = [
            'success' => 'ok',
            'message' => $message,
            'data'    => $result
        ];
        
        return response()->json($response, 200);
    }

    /** 
     * Вывод ответа (ошибка)
     * 
     * @return \Illuminate\Http\Response 
     */
    public function sendFail($error, $errorMessages = []) {
    	$response = [
            'success' => 'fail',
            'message' => $error
        ];
        if(!(empty($errorMessages))){
            $response['data'] = $errorMessages;
        };
        
        return response()->json($response, 200);
    }
};
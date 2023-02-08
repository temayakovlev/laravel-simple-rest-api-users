<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Http\Controllers\BaseController;

class UserManageController extends BaseController {
    /** 
     * Поиск пользователя по ID
     * 
     * @return userInfo || false
     */ 
    private function findUser($id) {
        return (User::where('id', $id)->exists() ? User::find($id) : false);
    }
    
    /** 
     * Получение информации о пользователе по ID
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function getUser($id) {
        $validate = $this->validateUserData(['id' => $id], 'userID');
        if ($validate->fails()) {
            return $this->sendFail($validate->errors(), '');
        };

        $user = $this->findUser($id);
        if (!($user)) {
            return $this->sendFail('User not found', '');
        };

        return $this->sendSuccess($user, '');
    }

    /** 
     * Обновление информации (имя и email) пользователя по ID
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function updateUser(Request $request, $id) {
        $validate = $this->validateUserData($request->all(), 'userData');
        if ($validate->fails()) {
            return $this->sendFail($validate->errors(), '');
        };

        $user = $this->findUser($id);
        if (!($user)) {
            return $this->sendFail('User not found', '');
        };

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        return $this->sendSuccess($user, '');
    }

    /** 
     * Удаление пользователя с указанным ID
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function deleteUser($id) {
        $validate = $this->validateUserData(['id' => $id], 'userID');
        if ($validate->fails()) {
            return $this->sendFail($validate->errors(), '');
        };

        $user = $this->findUser($id);
        if (!($user)) {
            return $this->sendFail('User not found', '');
        };

        $user->delete();
    
        return $this->sendSuccess('', 'User deleted');
    }
};
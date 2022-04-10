<?php

namespace App\Http\Controllers\api;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $messages = [
            'unique'=>"Este :attribute ya existe",
        ];
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ], $messages);

        if ($validator->fails()) {
	        return AppHelper::instance()->fail($validator, $request);
        }
        $data_user = $request->only('email');
        $data_user['password'] = bcrypt($request->password);
        $data_user['role'] = "user";
        $user = User::create($data_user);
        //create profile
        $data_profile = $request->except('email', 'password');
        $data_profile['user_id'] = $user->id;
        $profile = Profile::create($data_profile);
        return AppHelper::instance()->success(User::whereId($user->id)->with('profile')->first());
    }
}

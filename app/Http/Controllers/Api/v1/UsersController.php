<?php

namespace App\Http\Controllers\Api\v1;


use App\Http\Resources\v1\User as UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function login(Request $request)
    {
        // Validation Data
        $validData = $this->validate($request, [
            'mobile' => 'required|exists:users',
            'password' => 'required'
        ]);

        // Check Login User
        if (!auth()->attempt($validData)) {
            return response([
                'data' => 'اطلاعات صحیح نیست',
                'status' => 'error'
            ], 403);
        }

        return new UserResource(auth()->user());
    }


    public function getUser(){
        return new UserResource(auth()->user());
    }
}



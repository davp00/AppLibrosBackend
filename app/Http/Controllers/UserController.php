<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Login(Request $request)
    {
        return $request->input();
    }

    public function Register(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|max:258',
            'password' => 'required'
        ]);

        $findUser = User::where('email', $request->input('email') )->first();

        if(! $findUser )
        {
            $data = $request->all();
            $data['password'] = encrypt($data['password']);
            $user = User::create($data);
        }else
            return ['error' => true, 'message' => 'Ya existe un usuario con este correo'];
    }

}

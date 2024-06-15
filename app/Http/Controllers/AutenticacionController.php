<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Validation\Rules\Unique;
use stdClass;
use Illuminate\Support\Facades\Hash;

class AutenticacionController extends Controller
{
 
    public function registro(Request $request){
        
        $validator= Validator::make($request->all(),[
            'name'=>'required|string|max:50',
            'email'=>'required|string|email|max:255|unique:users',
            'password'=> 'required|string|min:8'

        ]);

        if($validator->fails()){

            return response()->json($validator->errors());
        }

        $usuario=User::create([
            'name'=>$request->name,
            'email'=> $request->email,
            'password'=> Hash::make($request->password)
        ]);

        $token= $usuario->createToken('auth_token')->plainTextToken;
        
        return response()->Json([
            'data'=>$usuario, 
            'tokenDeAcceso'=> $token,
            'tipoDeToken'=>'Bearer'
        ]);
    
    }

}

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
            'datos'=>$usuario, 
            'tokenDeAcceso'=> $token,
            'tipoDeToken'=>'Bearer'
        ]);
    
     }

    public function ingreso(Request $request){

        if(!Auth::attempt($request->only('email', 'password')))
        {
            return response()->json([
                'message'=>'No esta autorizado'
            ],401);
        }
        $user = User::where('email', $request['email'])->firstOrFail();
        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->Json([
            'message'=>'Bienvenido '.$user->name,
            'token'=> $token,
            'tipo de token'=>'Bearer',
            'Usuario'=> $user
        ]);


    }

    public function salir(){

        auth()->user()->tokens()->delete();

        return response()->Json([
            'mensaje'=>'cesion cerrada'
        ]);
    }

}

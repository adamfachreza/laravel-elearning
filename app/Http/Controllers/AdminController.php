<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Admin;

class AdminController extends Controller
{
    //
    public function tambahAdmin(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required',
            'token' => 'required'

        ]);

        // cek Validator
        if($validate->fails()){
            return response()->json([
                'status' => 'gagal',
                'message' => $validate->getMessageBag()
            ]);
        }

        if(Admin::create(
            [
                'name' => $request->name,
                'email' => $request->email,
                'password' => encrypt($request->password)
            ],
            )){
                return response()->json([
                    'status' => 'berhasil',
                    'message' => 'data berhasil di simpan'
                ]);

            }else{
                return response()->json([
                    'status' => 'gagal',
                    'message' => 'data gagal di simpan'
                ]);
            }

        // cek Token
        // $token = $request->token;
        // $tokenDB = Admin::where('token',$token)->count();
        // if($tokenDB > 0){
        //     $key = env('APP_KEY');
        //     $decode = JWT::decode($token, $key, array('HS256'));
        //     $decode_array = (array) $decode;
        //     if($decode_array['extime'] > time());

        //         }else{
        //             return response()->json([
        //                 'status' => 'gagal',
        //                 'message' => 'Token Expired'
        //             ]);

        // }
    }
}

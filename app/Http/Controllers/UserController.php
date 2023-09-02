<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

class UserController extends Controller
{
    //

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api');
    }

    /**
     * Update profil
     *
     * @return \Illuminate\Http\JsonResponse
    */
    public function UpdateProfil(Request $request){

        try {
            //code...

            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'username' => 'required',
                'email' => 'required|email'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            $checkUser = User::find($request->id);
    
            if (!$checkUser) {
                return response()->json([
                    'status' => false,
                    'message' => "L'utilisateur est introuvable"
                ], 404);
            } else {
    
                if($request->email === $checkUser->email){

                    $updateUser = $checkUser->update([
                        'username' => $request->username
                    ]);
    
                } else {
                    $updateUser = $checkUser->update([
                        'username' => $request->username,
                        'email' => $request->email,
                        'email_verified_at' => null
                    ]);
    
                }

                $finalResultUser = User::find($request->id);
    
                return response()->json([
                    "status" => true,
                    "message" => "Vos informations ont bien été mis à jour.",
                    "data" => $finalResultUser
                ]);
    
            }

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                "status" => false,
                "message" => $th
            ]);
        }

    }


}

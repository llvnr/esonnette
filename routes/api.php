<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Models\User;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {

    // Mise à jour Profil 
    Route::post('/update', function(Request $request) {

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

    });

    // Mise à jour Profil 

    Route::post('/chugc', [AuthController::class, 'CAAGC']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});
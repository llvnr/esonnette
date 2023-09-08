<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\Models\Alerte;

class AlerteController extends Controller
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
     * Get All By ID
     *
     * @return void
    */

    public function index(Request $request){

        try {
            //code...

            $validator = Validator::make($request->all(), [
                'id' => 'required'
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
    
            $id = $request->id;
    
            $alerte = Alerte::where('propriete_id', $id)->get();
    
            return response()->json([
                "status" => true,
                "result" => $alerte
            ]);

        } catch (\Throwable $th) {
            //throw $th;

            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ], 500);

        }

    }

    /**
     * Create Alerte
     *
     * @return void
    */

    public function create(Request $request){

        try {
            //code...

            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'type' => 'required',
                'data' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $id = $request->id;
            $type = $request->type;
            $data = $request->data;

            $checkAlerte = Alerte::where('propriete_id', $id)->where('type', $type)->exists();

            if($checkAlerte){
                return response()->json([
                    "status" => false,
                    "message" => "Une alerte [".$type."] existe déjà."
                ]);
            } else {

                $create = Alerte::create([
                    "propriete_id" => $id,
                    "type" => $type,
                    "informations" => $data,
                    "etat" => 1
                ]);
    
                return response()->json([
                    "status" => true,
                    "result" => $create
                ]);

            }

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ], 500);
        }

    }

}

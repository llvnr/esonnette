<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class GeneralController extends Controller
{
    //

    /**
     * Show Dashboard Data
     *
     * @return \Illuminate\Http\JsonResponse
    */

    public function index() {

        try {
            //code...

            $utilisateur = User::count();

            return response()->json([
                "status" => true,
                "data" => [
                    "utilisateur" => $utilisateur
                ]
            ]);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                "status" => false,
                "message" => $th
            ]);
        }

    }

}

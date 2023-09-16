<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

use App\Models\User;
use App\Models\Role;
use App\Models\Propriete;
use App\Models\Visite;

class GeneralController extends Controller
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
     * Show Dashboard Data
     *
     * @return \Illuminate\Http\JsonResponse
    */

    public function index() {

        try {
            //code...

            $utilisateur = User::count();
            $role = Role::count();
            $propriete = Propriete::count();
            $alerte = Visite::count();
            $alerteEmail = Visite::whereHas('alerte', function ($query) {
                $query->where('type', 'email');
            })->count();
            $alerteDiscord = Visite::whereHas('alerte', function ($query) {
                $query->where('type', 'discord');
            })->count();
            $alerteSms = Visite::whereHas('alerte', function ($query) {
                $query->where('type', 'sms');
            })->count();
            $alerteSlack = Visite::whereHas('alerte', function ($query) {
                $query->where('type', 'slack');
            })->count();

            return response()->json([
                "status" => true,
                "data" => [
                    "utilisateur" => $utilisateur,
                    "role" => $role,
                    "propriete" => $propriete,
                    "notification" => $alerte,
                    "notification_email" => $alerteEmail,
                    "notification_discord" => $alerteDiscord,
                    "notification_sms" => $alerteSms,
                    "notification_slack" => $alerteSlack
                ]
            ]);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ], 500);
        }

    }

}

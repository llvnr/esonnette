<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class ProprieteController extends Controller
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

    public function testQrcode() {

        try {
            //code...

            $appURL = env('APP_URL');

            $qrCode = base64_encode(QrCode::format('png')->generate($appURL));
    
            return response()->json([
                "status" => true,
                "message" => "Test QRCode avec succès.",
                "data" => $qrCode
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ], 500);
        }

    }

}

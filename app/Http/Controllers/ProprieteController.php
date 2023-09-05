<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use App\Models\Propriete;

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

    public function testQrcode(Request $request) {

        try {
            //code...

            $validator = Validator::make($request->all(), [
                'nom' => 'required',
                'prenom' => 'required',
                'typepropriete' => 'required',
                'adresse' => 'required',
                'codepostal' => 'required',
                'ville' => 'required'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $appURL = env('APP_URL');

            $qrCode = base64_encode(QrCode::format('png')->generate($appURL));
            $nom = $request->nom;
            $prenom = $request->prenom;
            $typepropriete = $request->typepropriete;
            $adresse = $request->adresse;
            $codepostal = $request->codepostal;
            $ville = $request->ville;

            $checkProprietaire = Propriete::where('nom', $nom)
            ->where('prenom', $prenom)
            ->where('typepropriete', $typepropriete)
            ->where('adresse', $adresse)
            ->where('codepostal', $codepostal)
            ->where('ville', $ville)
            ->exists();

            if($checkProprietaire){

                return response()->json([
                    "status" => false,
                    "message" => "Désolé, une propriété est déjà associé à ce propriétaire."
                ]);

            } else {

                $checkPropriete = Propriete::where('adresse', $adresse)
                ->where('codepostal', $codepostal)
                ->where('ville', $ville)
                ->exists();

                if($checkPropriete){
                    return response()->json([
                        "status" => false,
                        "message" => "Désolé, une propriété existe déjà."
                    ]);
                } else {

                    $addPropriete = Propriete::create([
                        "qrcode" => $qrCode,
                        "nom" => $nom,
                        "prenom" => $prenom,
                        "typepropriete" => $typepropriete,
                        "adresse" => $adresse,
                        "codepostal" => $codepostal,
                        "ville" => $ville
                    ]);

                }

            }

            return response()->json([
                "status" => true,
                "message" => "Votre propriété a été créer avec succès.",
                "result" => $addPropriete
            ]);

        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ], 500);
        }

    }

}

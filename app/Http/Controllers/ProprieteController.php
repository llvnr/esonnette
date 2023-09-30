<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

use App\Models\Propriete;
use App\Models\Alerte;
use App\Models\Visite;
use App\Models\Sticker;

use Illuminate\Support\Facades\Mail;
use App\Mail\SendSonnetteMail;

class ProprieteController extends Controller
{
    //

    /**
     * Create a new AuthController instance.
     *
     * @return void
    */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['showNoLogin', 'scan']]);
    }

    /**
     * Get All Propriete By ID
     *
     * @return void
    */

    public function index(Request $request) {

        try {
            //code...

            $all = Propriete::where('user_id', auth()->user()->id)->get();

            return response()->json([
                "status" => true,
                "result" => $all
            ]);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ], 500);
        }

    }

    public function create(Request $request) {

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

            $nom = $request->nom;
            $prenom = $request->prenom;
            $typepropriete = $request->typepropriete;
            $adresse = $request->adresse;
            $codepostal = $request->codepostal;
            $ville = $request->ville;
            $typeAlert = $request->typeAlert;
            $alertData = $request->alertData;

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
                        "user_id" => auth()->user()->id,
                        "qrcode" => "data:image/png;base64",
                        "nom" => $nom,
                        "prenom" => $prenom,
                        "typepropriete" => $typepropriete,
                        "adresse" => $adresse,
                        "codepostal" => $codepostal,
                        "ville" => $ville,
                        "status" => true
                    ]);

                    $appURL = env('APP_URL')."propriete/qrcode/".$addPropriete->id;
                    $qrCode = base64_encode(QrCode::format('png')->size(500)->generate($appURL));

                    $addPropriete->update([
                        "qrcode" => "data:image/png;base64,".$qrCode
                    ]);

                    $configurationInitial = [
                        "border" => "#000000",
                        "background" => "#FFFFFF",
                        "title" => "#3056D3",
                        "subtitle" => "#000000",
                        "backgroundQrcode" => "#FFFFFF",
                        "colorQrcode" => "#FFFFFF",
                        "separation" => "#000000",
                        "signature" => "#000000"
                    ];

                    $createSticker = Sticker::create([
                        "user_id" => auth()->user()->id,
                        "propriete_id" => $addPropriete->id,
                        "configuration" => $configurationInitial
                    ]);

                    $createAlerte = Alerte::create([
                        "propriete_id" => $addPropriete->id,
                        "type" => $typeAlert,
                        "informations" => $alertData,
                        "etat" => 2
                    ]);

                    return response()->json([
                        "status" => true,
                        "message" => "Votre propriété a été créer avec succès.",
                        "result" => $addPropriete
                    ]);

                }

            }

        } catch (\Throwable $th) {
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ], 500);
        }

    }

    /**
     * Show One By ID
     *
     * @return void
    */

    public function show(Request $request){

        try {
            //code...

            $validator = Validator::make($request->all(), [
                'id' => 'required'
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $id = $request->id;

            $getPropriete = Propriete::with('Alerte')->find($id);

            return response()->json([
                "status" => true,
                "result" => $getPropriete
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
     * Show One By ID No LOGIN
     *
     * @return void
    */

    public function showNoLogin(Request $request){

        try {
            //code...

            $validator = Validator::make($request->all(), [
                'id' => 'required'
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $id = $request->id;

            $getPropriete = Propriete::with('Alerte')->find($id);

            return response()->json([
                "status" => true,
                "result" => $getPropriete
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
     * Update One By ID
     *
     * @return void
    */

    public function update(Request $request){

        try {
            //code...

            $validator = Validator::make($request->all(), [
                'id' => 'required'
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $id = $request->id;

            $propriete = Propriete::find($id);
            
            $nom = $request->nom !== null ? $request->nom : $propriete->nom;
            $prenom = $request->prenom !== null ? $request->prenom : $propriete->prenom;
            $adresse = $request->adresse !== null ? $request->adresse : $propriete->adresse;
            $codepostal = $request->codepostal !== null ? $request->codepostal : $propriete->codepostal;
            $ville = $request->ville !== null ? $request->ville : $propriete->ville;
            $status = $request->status !== null ? $request->status : $propriete->status;

            $updatePropriete = $propriete->update([
                "nom" => $nom,
                "prenom" => $prenom,
                "adresse" => $adresse,
                "codepostal" => $codepostal,
                "ville" => $ville,
                "status" => $status
            ]);

            $propriete = Propriete::find($id);

            return response()->json([
                "status" => true,
                "result" => $propriete
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
     * Scan function
     *
     * @return void
    */

    public function scan(Request $request) {

        try {
            //code...
            $validator = Validator::make($request->all(), [
                'id' => 'required',
                'denomination' => 'required',
                'telephone' => 'required'
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $id = $request->id;
            $denomination = $request->denomination;
            $telephone = $request->telephone;
            // Récupérez l'adresse IP du visiteur
            $ip = $request->getClientIp();

            $infosCanal = Alerte::where('propriete_id', $id)->where('etat', 2)->first();

            $date = date('Y-m-d');

            $checkSecuriteAnonymous = Visite::where('propriete_id', $id)
            ->where('adresse_ip', $ip)
            ->where('denomination', $denomination)
            ->where('telephone', $telephone)
            ->where('created_at', 'LIKE', '%'.$date.'%')
            ->count();

            if($checkSecuriteAnonymous >= 3){
                return response()->json([
                    "status" => false,
                    "result" => $checkSecuriteAnonymous,
                    "message" => "Vous avez déjà sonné 3 fois. Revenez demain."
                ]);
            } else {

                $checkSecurite = Visite::where('propriete_id', $id)
                ->where('adresse_ip', $ip)
                ->where('denomination', '!=', "Inconnu")
                ->where('telephone', '!=', "Inconnu")
                ->where('created_at', 'LIKE', '%'.$date.'%')
                ->count();

                if($checkSecurite >= 1){
                    return response()->json([
                        "status" => false,
                        "result" => $checkSecurite,
                        "message" => "Vous m'avez déjà informé de votre visite aujourd'hui. Revenez demain."
                    ]);
                } else {

                    $createVisite = Visite::create([
                        "propriete_id" => $id,
                        "alerte_id" => $infosCanal->id,
                        "adresse_ip" => $ip,
                        "denomination" => $denomination,
                        "telephone" => $telephone,
                        "etat" => 1
                    ]);
    
                    if($infosCanal->type === "email"){
                        $details = [
                            'denomination' => $denomination,
                            'telephone' => $telephone,
                            'date' => $createVisite->created_at
                        ];
                        
                        Mail::to($infosCanal->informations)->send(new SendSonnetteMail($details));
    
                        return response()->json([
                            "status" => true,
                            "message" => "Le propriétaire a été informé par email de votre visite."
                        ]); 
                    } elseif ($infosCanal->type === "discord") {
                        # code...
                        $curl = curl_init();
    
                        curl_setopt_array($curl, array(
                        CURLOPT_URL => $infosCanal->informations,
                        CURLOPT_RETURNTRANSFER => true,
                        CURLOPT_ENCODING => '',
                        CURLOPT_MAXREDIRS => 10,
                        CURLOPT_TIMEOUT => 0,
                        CURLOPT_FOLLOWLOCATION => true,
                        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                        CURLOPT_CUSTOMREQUEST => 'POST',
                        CURLOPT_POSTFIELDS =>'{
                            "username": "ESONNETTE",
                            "content": "Quelqu\'un vient de sonner ! ['.$denomination.' / '.$telephone.']"
                        }',
                        CURLOPT_HTTPHEADER => array(
                            'Content-Type: application/json',
                        ),
                        ));
    
                        $response = curl_exec($curl);
    
                        curl_close($curl);
    
                        return response()->json([
                            "status" => true,
                            "result" => $response
                        ]);
                    } 

                }  

            }

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                "status" => false,
                "message" => $th->getMessage()
            ], 500);
        }

    }

    /**
     * Get Sticker By ID Property
     *
     * @return void
    */

    public function getSticker(Request $request) {

        try {
            //code...
            $validator = Validator::make($request->all(), [
                'idPropriete' => 'required'
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $idPropriete = $request->idPropriete;

            $getSticker = Sticker::where('propriete_id', $idPropriete)->first();

            return response()->json([
                "status" => true,
                "result" => $getSticker
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
     * Update sticker By ID Property
     *
     * @return void
    */

    public function updateSticker(Request $request) {

        try {
            //code...

            $validator = Validator::make($request->all(), [
                'idPropriete' => 'required',
                'border' => 'required',
                'background' => 'required',
                'title' => 'required',
                'subtitle' => 'required',
                'backgroundQrcode' => 'required',
                'colorQrcode' => 'required',
                'separation' => 'required',
                'signature' => 'required'
            ]);
    
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $idPropriete = $request->idPropriete;

            $border = $request->border;
            $background = $request->background;
            $title = $request->title;
            $subtitle = $request->subtitle;
            $backgroundQrcode = $request->backgroundQrcode;
            $colorQrcode = $request->colorQrcode;
            $separation = $request->separation;
            $signature = $request->signature;

            $nouvelleConfiguration = [
                "border" => $border,
                "background" => $background,
                "title" => $title,
                "subtitle" => $subtitle,
                "backgroundQrcode" => $backgroundQrcode,
                "colorQrcode" => $colorQrcode,
                "separation" => $separation,
                "signature" => $signature
            ];

            $getSticker = Sticker::where('propriete_id', $idPropriete)->first();
            $updateSticker = $getSticker->update([
                "configuration" => $nouvelleConfiguration
            ]);

            return response()->json([
                "status" => true,
                "result" => $updateSticker
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

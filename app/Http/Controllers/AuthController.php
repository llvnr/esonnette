<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use Tymon\JWTAuth\Facades\JWTAuth;

use Illuminate\Support\Facades\Mail;
use App\Mail\CodeConfirmationMail;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['CAAGC', 'login', 'register']]);
    }

    /**
     * Generate confirm account code. (CAAGC = CheckAccountAndGenerateCode)
     *
     * @return \Illuminate\Http\JsonResponse
    */
    public function CAAGC(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $checkUser = User::where('email', $request->email)->first();
        if (!$checkUser) {
            return response()->json([
                "status" => false,
                "message" => 'Utilisateur introuvable'
            ]);
        } else {
            $generateCode = rand(100000, 999999);

            $updateUser = $checkUser->update([
                "code" => $generateCode
            ]);

            // NE PAS OUBLIER L'ENVOIE DE MAIL PLUS TARD
            $details = [
                'code' => $generateCode
            ];
           
            Mail::to($request->email)->send(new CodeConfirmationMail($details));

            return response()->json([
                "status" => true,
                "message" => "Si l'utilisateur existe, un code d'authentification sera générer. Vous allez être rédirigé...",
                "code" => $generateCode
            ]);

        }

    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
    	$validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'code' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $user = User::where('email', $request->email)
        ->where('code', $request->code)
        ->first();

        if (!$user) {
            return response()->json([
                'status' => false,
                "message" => "Utilisateur introuvable ou code incorrect."
            ]);
        } else if (! $token = JWTAuth::fromUser($user)) {
            return response()->json([
                "status" => false,
                'message' => 'Non autorisé.'
            ]);
        }

        // Authentifiez l'utilisateur manuellement
        Auth::login($user);

        $resetCode = $user->update([
            "code" => null
        ]);

        return response()->json([
            "status" => true,
            "result" => $this->createNewToken($token)
        ]);
      
    }
    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request) {
        $validator = Validator::make($request->all(), [
            'role_id' => 'required',
            'username' => 'required|string|between:2,100',
            'email' => 'required|string|email|max:100|unique:users'
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge($validator->validated()));

        return response()->json([
            'message' => 'User successfully registered',
            'user' => $user
        ], 201);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();
        return response()->json(['message' => 'User successfully signed out']);
    }
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }
    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json(auth()->user());
    }
    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }
}
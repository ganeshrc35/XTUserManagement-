<?php

namespace App\Http\Controllers;
use App\Manager\UserManager;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Validator;
use JWTAuth;

class APIV1Controller extends Controller
{
    /**
     * Constructor
     *
     * @var userManager
     */
    protected $userManager;
    
    public function __construct(UserManager $userManager) {
        $this->userManager = $userManager;
    }
    /**
     * Login API
     *
     * @return array
     */
    public function login(Request $request){
        try{
            $rules = [
                        'email' => 'required | email',
                        'password' => 'required'
                    ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(['errors' => $validator->errors()->toJson(),'status_code' => 400]);
            }
            if (! $token = JWTAuth::attempt($request->all())) {
                return response()->json(['error' => 'Unauthorized', 'status_code' => 401]);
            }
            return response()->json([
                'status_code' => 200,
                'access_token' => $token,
                'token_type' => 'bearer'
            ]);
        }catch(Exception $e){
            return response()->json(['status_code' => 400,'message' => $e->getMessage()]);
        }
    }
    /**
     * Get User
     * @param Bearer auth_token
     * @return array
     */
    public function getUser(Request $request){
        try{
            $user = JWTAuth::authenticate($request->token);
            return response()->json(['user' => $user,'status_code' => 200]);
        }catch(Exception $e){
            return response()->json(['status_code' => 400,'message' => $e->getMessage()]);
        }
    }
    /**
     * Logout
     * @param Bearer auth_token
     * @return array
     */
    public function logout(Request $request){
        try{
            JWTAuth::invalidate($request->token);
            return response()->json(['status_code' => 200,'message' => 'User logged out successfully']);
        }catch(Exception $e){
            return response()->json(['status_code' => 400,'message' => $e->getMessage()]);
        }   
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Manager\UserManager;
use Auth;
use Validator;

class UserController extends Controller
{
    //
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
     * Get the list of users
     *
     * @return array
     */
    public function index(){
        try{
            return view('layouts.list_users');
        }catch(Exception $e){

        }
    }
    /**
     * Redirect to create user page
     *
     * @return void
     */
    public function create(){
        try{
            return view('layouts.create_users');
        }catch(Exception $e){

        }
    }
    /**
     * Redirect to create user page
     *
     * @return array
     */
    public function get(){
        $users = $this->userManager->getUsers();
        return $users;
    }
    /**
     * Store User
     *
     * @return array
     */
    public function store(Request $request){
        try{
            $rules = [
                        'name' => 'required',
                        'email' => 'required | unique:users',
                        'username' => 'required | unique:users',
                        'password' => 'required | confirmed | min:10',
                        'mobile_number' => 'required | integer',
                        'dob' => 'required | date',
                        'profile_image' => 'mimes:png,jpg,jpeg|max:2048'
                    ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return Redirect('/createUser')
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $createUser = $this->userManager->create($request);
                return redirect()->back()->with(($createUser['status_code'] == 200)?'message':'error',$createUser['message']);
            }
        }catch(Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
    /**
     * Store User
     * @params $userId
     * @return array
     */
    public function view($userId){
        try{
            $userDetails = $this->userManager->view($userId);
            return view('layouts.view_user')->with('user',$userDetails['user']);
        }catch(Exception $e){

        }
    }
    /**
     * Edit User
     * @params $userId
     * @return array
     */
    public function edit($userId){
        try{
            $userDetails = $this->userManager->view($userId);
            return view('layouts.edit_user')->with('user',$userDetails['user']);
        }catch(Exception $e){

        }
    }
    /**
     * Edit User
     * @params $userId
     * @return array
     */
    public function update($userId,Request $request){
        try{
            $rules = [
                        'name' => 'required',
                        'email' => 'required | unique:users,email,'.$userId,
                        'username' => 'required | unique:users,email,'.$userId,
                        'mobile_number' => 'required | integer',
                        'dob' => 'required | date',
                        'profile_image' => 'mimes:png,jpg,jpeg|max:2048'
                    ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return Redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            } else {
                $createUser = $this->userManager->update($request,$userId);
                return redirect()->back()->with(($createUser['status_code'] == 200)?'message':'error',$createUser['message']);
            }
        }catch(Exception $e){
            return redirect()->back()->with('error',$e->getMessage());
        }
    }
    /**
     * Delete User
     * @params $userId
     * @return array
     */
    public function delete($userId){
        try{
            return $this->userManager->delete($userId);
        }catch(Exception $e){
            return ['status_code' => 400,'message' => $e->getMessage()];
        }
    }
    /**
     * Check if user is authenticated
     *
     * @return void
     */
    public function showLogin(){
        if (Auth::check()) {
            return redirect('dashboard');
        } else {
            return view('auth.login');
        }
    }
    /**
     * Logout the user
     *
     * @return void
     */
    public function logout(){
        Auth::logout();
        return Redirect('/')->with('message', 'You are logged out!');
    }
}

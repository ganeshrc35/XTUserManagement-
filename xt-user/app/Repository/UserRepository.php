<?php
namespace App\Repository;
use App\User;
use DataTables;

class UserRepository{
	/**
    * Get users
    * @return array
    */
	public function getUsers(){
		$users = User::where('email','!=',env('SUPER_ADMIN_EMAIL'));
		return DataTables::of($users)
				->addColumn('view', function($row){
                	$btn = '<a href="viewUser/'.base64_encode($row->id).'" data-toggle="tooltip" data-original-title="Edit" class="btn btn-info">
                                View
                            </a>';
                    return $btn;
                })
				->addColumn('edit', function($row){
                	$btn = '<a href="edit/'.base64_encode($row->id).'" data-toggle="tooltip" data-original-title="Edit" class="btn btn-primary">
                                Edit
                            </a>';
                    return $btn;
                })
                ->addColumn('delete', function($row){
                	$btn = '<a href="delete/'.base64_encode($row->id).'" class="btn btn-danger delete_user">
                                Delete
                            </a>';
                    return $btn;
                })
                ->rawColumns(['view','edit','delete'])
				->make(true);
	}
	/**
    * Create User
    * @param $payload
    * @param $uploadedFileName
    * @return array
    */
    public function create($request, $uploadedFileName){
    	try{
    		$request = $request->all();
    		$request['profile_image'] = $uploadedFileName;
    		User::create($request);
    		return ['status_code' => 200,'message' => 'User created successfully'];
    	}catch(Exception $e){
    		return ['status_code' => 400,'message' => $e->getMessage()];
    	}
    }
    /**
    * Get User
    * @param $userId
    * @return array
    */	
    public function getUser($userId){
    	try{
    		$user = User::where('id',base64_decode($userId))->first();
    		return ['status_code' => 200,'user' => $user];
    	}catch(Exception $e){
    		return ['status_code' => 400,'message' => $e->getMessage()];
    	}
    }
    /**
    * Update User
    * @param $payload
    * @param $uploadedFileName
    * @param $userId
    * @return array
    */
    public function update($request, $uploadedFileName, $userId){
    	try{
    		$request = $request->all();
    		unset($request['_token']);
    		if(!empty($uploadedFileName))
    			$request['profile_image'] = $uploadedFileName;
    		User::where('id',$userId)->update($request);
    		return ['status_code' => 200,'message' => 'User updated successfully'];
    	}catch(Exception $e){
    		return ['status_code' => 400,'message' => $e->getMessage()];
    	}
    }
    /**
     * Delete User
     * @params $userId
     * @return array
     */
    public function delete($userId){
    	try{
    		$userModel = User::find(base64_decode($userId));
    		$userModel->delete();
    		return ['status_code' => 200,'message' => 'User deleted successfully'];
    	}catch(Exception $e){
    		return ['status_code' => 400,'message' => $e->getMessage()];
    	}
    }
}
?>
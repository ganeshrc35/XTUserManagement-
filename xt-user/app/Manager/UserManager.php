<?php
namespace App\Manager;
use App\Repository\UserRepository;
use App\Services\Uploader;
use Illuminate\Http\Request;
/**
 * Class UserManager
 * @package App\Manager
 */
class UserManager{
	 /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var uploader
     */
    private $uploader;

    /**
     * UserManager constructor.
     * @param userRepository $userRepository
     * @param uploader
     */
    public function __construct(
        UserRepository $userRepository,
        Uploader $uploader
    )
    {
        $this->userRepository = $userRepository;
        $this->uploader = $uploader;
    }
    /**
    * Get Users
    * @return array
    */
    public function getUsers(){
        return $this->userRepository->getUsers();
    }
    /**
    * Create User
    * @param $payload
    * @return array
    */
    public function create($request){
        try{
            //Check if profile image is uploaded.
            $uploadFileUrl = '';
            if($_FILES['profile_image']){
                $uploadFile = $this->uploader->upload($request->file('profile_image'));
                $uploadFileUrl = ($uploadFile['status_code'] == 200)?$uploadFile['fileName']:'';
            }
            $storeData = $this->userRepository->create($request,$uploadFileUrl);
            return $storeData;
        }catch(Exception $e){
            return ['status_code' => 400,'message' => $e->getMessage()];
        }
    }
    /**
    * Update User
    * @param $payload
    * @param $userId
    * @return array
    */
    public function update($request,$userId){
        try{
            //Check if profile image is uploaded.
            $uploadFileUrl = '';
            if(!is_null($request->file('profile_image'))){
                $uploadFile = $this->uploader->upload($request->file('profile_image'));
                $uploadFileUrl = ($uploadFile['status_code'] == 200)?$uploadFile['fileName']:'';
            }
            $storeData = $this->userRepository->update($request,$uploadFileUrl,$userId);
            return $storeData;
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
            return $this->userRepository->delete($userId);
        }catch(Exception $e){
            return ['status_code' => 400,'message' => $e->getMessage()];
        }
    }
    /**
    * View User
    * @param $userId
    * @return array
    */
    public function view($userId){
        try{
            return $this->userRepository->getUser($userId);
        }catch(Exception $e){

        }
    }
}
?>
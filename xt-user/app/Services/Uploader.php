<?php
/**
 * Class Uploader
 * @service App\Services
 */
namespace App\Services;
use Illuminate\Support\Facades\Storage;
class Uploader{
	/**
	 * To upload files
	 * @param $request
	 * @response string
	 */
	public function upload($profile_image){
		try{
			$curr_date	=	date('Ymdhis');
			$basename 	= 	$profile_image->getClientOriginalName(); // get the original filename + extension
	        $extension 	= 	$profile_image->getClientOriginalExtension(); // get the original extension without the dot
	        $filename 	= 	basename($basename, '.' . $extension); // get the original filename only
			$fileName	=	$curr_date.'-'.$filename.'.'.$extension;
			Storage::disk('public')->put($fileName, file_get_contents($profile_image));
			return ['status_code' => 200, 'fileName' => $fileName];
		}catch(Exception $e){
			return ['status_code' => 400, 'message' => $e->getMessage()];
		}
	}
}
?>
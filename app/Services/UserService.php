<?php
namespace App\Services;

use App\Http\Resources\Products\GetAllResource;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Hash;

class UserService{
    use ApiResponse;
    protected $userRepo;
    protected $limit=10;
   public function __construct(UserRepository $userRepo){
        $this->userRepo=$userRepo;
   }
   public function create($request){
  
    if($request->input('password') !==$request->input('confirm_password')) return $this->apiResponse([],'password is invalid',false,422);
    $data=[
        'name'=>$request->input('name')??'user',
        'email'=>$request->input('email'),
        'password'=>Hash::make($request->input('password'))
    ];
    $result=$this->userRepo->create($data);
    
    $isSuccess=true;
        if($result ==[]){
            $isSuccess=false;
        }
        return $this->apiResponse($isSuccess ? $result : [],'data',$isSuccess,$isSuccess?200:422);
   }
   
}

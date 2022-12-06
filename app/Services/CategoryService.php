<?php
namespace App\Services;

use App\Helpers\Helper;
use App\Http\Resources\Category\GetAllResource;
use App\Http\Resources\Category\ShowResource;
use App\Repositories\CategoryRepository;
use App\Traits\ApiResponse;

class CategoryService{
    use ApiResponse;
    protected $categoryRepo;
    protected $limit=10;
   public function __construct(CategoryRepository $categoryRepo){
        $this->categoryRepo=$categoryRepo;
   }

   public function getAll($request){
    $search=[];
    $search['limit']=isset($request->limit) ? $request->limit: $this->limit;
    $data=[];
        $categories=$this->categoryRepo->getAll($search);
        if(!is_null($categories)){
            $data=GetAllResource::collection($categories)->response()->getData();
        }
    return $this->apiResponse($data,'List category');
   }

   public function show($id){
    if(is_null($id)) return $this->apiResponseError();
    $category=$this->categoryRepo->find($id);
    $data=[];
    if(!is_null($category)){
        $data=new ShowResource($category);
    }
    return $this->apiResponse($data,'Show category');
   }


   public function create($request){
    if(is_null($request)) return $this->apiResponseError();
    $fileName= Helper::saveImgBase64($request->input('image'),'Category');
    if($fileName == false) return $this->apiResponseError([],'The image is not in the correct format');
    $request['image']=$fileName;
    $request['status']=!isset($request->status) ? 'Active':$request->status;
    $request['parent_id']=!isset($request->parent_id) ? 0 : $request->parent_id;
    $category=$this->categoryRepo->create($request->toArray());
    $data=[];
    if($category != [] || !is_null($category) ){
        $data=new ShowResource($category);
    }
    return $this->apiResponse($data,'Create category success.');
   }
}

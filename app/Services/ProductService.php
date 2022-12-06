<?php
namespace App\Services;

use App\Http\Resources\Products\GetAllResource;
use App\Http\Resources\Products\ShowResource;
use App\Repositories\ProductRepository;
use App\Traits\ApiResponse;

class ProductService{
    use ApiResponse;
    protected $productRepo;
    protected $limit=10;
   public function __construct(ProductRepository $productRepo){
        $this->productRepo=$productRepo;
   }

   public function getAll($request){
    $search=[];
    $search['limit']=isset($request->limit) ? $request->limit: $this->limit;
    $data=[];
        $products=$this->productRepo->getAll($search);
        if(!is_null($products)){
            $data=GetAllResource::collection($products)->response()->getData();
        }
    return $this->apiResponse($data,'List Products');
   }

   public function show($id){
    if(is_null($id)) return $this->apiResponseError();
    $product=$this->productRepo->find($id);
    $data=[];
    if(!is_null($product)){
        $data=new ShowResource($product);
    }
    return $this->apiResponse($data,'Show Products');
   }
}

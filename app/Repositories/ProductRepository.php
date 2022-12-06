<?php 
namespace App\Repositories;

use App\Models\Product;

class ProductRepository extends BaseRepository{
    protected $product;
    public function __construct(Product $product)
    {
        $this->product=$product;
        parent::__construct($product);
    }
    public function getAll($search=[])
    {
        return $this->product->with(['categories','product_details'])->orderBy('id','desc')->paginate($search['limit']);
    }
}
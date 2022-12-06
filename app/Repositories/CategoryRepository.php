<?php 
namespace App\Repositories;

use App\Models\Category;

class CategoryRepository extends BaseRepository{
    protected $category;
    public function __construct(Category $category)
    {
        $this->category=$category;
        parent::__construct($category);
    }
    public function getAll($search=[])
    {
        return $this->category->orderBy('id','desc')->paginate($search['limit']);
    }
}
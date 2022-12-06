<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected  $table = 'products';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'name',
        'status',
        'description',
        'image',
        'image_slide',

    ];
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function product_details()
    {
        return $this->hasOne(ProductDetail::class, 'product_id');
    }
}

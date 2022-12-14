<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected  $table = 'product_details';
    protected $fillable = [
        'product_id',
        'code_color',
        'amount',
        'price',
    ];
    public function product()
    {

        return $this->belongsTo(Product::class);
    }
}

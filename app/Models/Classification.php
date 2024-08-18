<?php

namespace App\Models;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classification extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id','classification_name','classification_sla'
    ];


    /**
     * Get Product name from user
     *
     * @return void
     */
    public function product_name()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}

<?php
namespace App\Models;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'cat_id','sub_cat_name'
    ];


    /**
     * Get Product name from user
     *
     * @return void
     */
    public function cat_name()
    {
        return $this->belongsTo(Category::class, 'cat_id', 'id');
    }
}

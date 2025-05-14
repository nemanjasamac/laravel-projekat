<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'title',
        'description',
        'price',
        'category_id',
        'is_featured',
        'image',
    ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'category_id'
    ];

    // protected function image(): Attribute 
    // {
    //     return Attribute::make(
    //         get: fn ($value) => 'http://localhost:8000' . ($value)
    //     );
    // }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function scopeFilter($query, $filters){
        // dd($filters);
        if(isset($filters['category'])){
            $query->whereHas('category', function($catQuery) use ($filters){
                $catQuery->where('name', $filters['category']);
            });
        }
    }
}

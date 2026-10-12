<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Category;

class News extends Model
{
    use HasFactory;
 protected $fillable = ['category_id',
 'user_id',
 'title',
 'body',
 'image'
 ];  

public function category()
{
    return $this->belongsTo(Category::class);
}
public function scopeSearch($query, $search)
{
    return $query->where('title','like', "%{$search}%");
}
public function scopeByCategory($query, $category)
{
return $query->where('category_id',$category);
}

}


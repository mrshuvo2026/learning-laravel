<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\News;


class Category extends Model
{
    use HasFactory;
protected $fillable = ['name'];

public function news()
{
    return $this->hasMany(News::class);
}

public function scopeWithNews($query)
{
return $query->with('news');
}
public function scopeSearch($query,$search)
{
    return $query->whereHas('news',function ($query) use ($search){
         $query->where('title','like',"%{$search}%");
    });
}

}

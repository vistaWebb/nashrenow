<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Comment;
use App\Models\Wishlist;
use App\Models\ProductRate;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory , Sluggable;


    protected $table = "products";
    protected $guarded = [];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    public function getIsActiveAttribute($is_active)
    {
        return $is_active ? 'فعال' : 'غیرفعال' ;
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function tags()
    {
        return $this->belongsToMany(Tag::class , 'product_tag');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
    public function rates()
    {
        return $this->hasMany(ProductRate::class);
    }
    public function approvedComments()
    {
        return $this->hasMany(Comment::class)->where('approved' , 1);
    }
    public function checkUserWishList($userId)
    {
        return $this->hasMany(Wishlist::class)->where('user_id' , $userId)->exists();
    }
}

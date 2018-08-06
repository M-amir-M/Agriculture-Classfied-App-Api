<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'description',
        'expected_price',
    ];

    protected $appends = ['thumbnail'];

    public function getThumbnailAttribute()
    {
        return $this->thumbnail();
    }

    public function thumbnail()
    {
        $tn = PostImage::where('post_id',$this->id)->first();
        return $tn['image'];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function images()
    {
        return $this->hasMany(PostImage::class);
    }
}

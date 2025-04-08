<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'is_published',
        'user_id',
    ];

    static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->slug = Str::slug($model->title);
            $exists = Blog::where('slug', $model->slug)->exists();
            $counter = 1;
            while ($exists) {
                $model->slug = $model->slug . '-' . $counter;
                $exists = Blog::where('slug', $model->slug)->exists();
                $counter++;
            }
        });
    }
}

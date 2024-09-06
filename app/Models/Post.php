<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    protected $table = 'posts';
    protected $fillable = ['name', 'slug', 'description', 'content',
        'seo_title', 'seo_description', 'seo_keywords',
        'category_id','views','rating_number','rating_value'];
    protected $with = ['category','images'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function images()
    {
        return $this->hasOne(Image::class, 'model_id')
            ->where('model_type', self::class);
    }

    public function deleteImages()
    {
        $images = Image::where('model_type', self::class)->where('model_id', $this->id)->get();
        foreach ($images as $image) {
            $image->delete();
        }
    }

}

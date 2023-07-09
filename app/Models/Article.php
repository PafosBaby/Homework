<?php

namespace App\Models;

use Carbon\Carbon;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = [
        'title',
        'slug',
        'short_description',
        'description',
        'image_path',
        'publich_at',
        'category_id',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public static function add(array $fields)
    {

        $article = new static;
        $article->fill($fields);
        $article->publich_at = date('Y-m-d');
        if (isset($fields['is_active'])) {
            $article->is_active = 1;
        } else {
            $article->is_active = 0;
        }
        $article->save();
        return $article;
    }


    public function isShowing()
    {
        return $this->is_active ? "Да" : "Нет";
    }

    public function uploadImage($image)
    {
        if ($image == null) return;
        $ext = $image->extension();
        if (!in_array($ext, ['jpg', 'jpeg', 'png', 'gif'])) return;

        $filename = 'article-' . $this->id;
        $fullFileName = $filename . "." . $ext;
        $path = $image->storeAs('articles', $fullFileName, 'uploads');
        $this->image_path = $path;
        $this->save();
    }

    public function getImage()
    {
        if ($this->image_path) {
            return asset('uploads/' .  $this->image_path);
        }
        return asset('admin-assets/img/no-image.jpg');
    }

    public function removeImage()
    {
        if ($this->image_path != null) {
            Storage::disk('uploads')->delete($this->image_path);
            $this->image_path = null;
            $this->save();
        }
    }


    public function getDate()
    {
        if ($this->publich_at == null) return;
        $str = '<div class="post-date-box">';
        $str .= Carbon::createFromFormat('Y-m-d', $this->publich_at)->format('d');
        $str .= '<span>';
        $str .= Carbon::createFromFormat('Y-m-d', $this->publich_at)->format('M, Y');
        $str .= '</span></div>';
        return $str;
    }

    public function getTags()
    {
        $tags = [];
        foreach ($this->tags as $tag) {
            $tags[] = $tag->name;
        }
        return implode(', ', $tags);
    }
}

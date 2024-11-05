<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'image_path',
        'is_premium_content'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class);
    }
}

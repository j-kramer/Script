<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Builder;

class Article extends Model
{
    use HasFactory;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['user:id,name', 'categories:id,name'];

    protected $fillable = [
        'title',
        'content',
        'image_path',
        'is_premium_content',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_premium_content' => 'boolean',
            'sponsored_untill' => 'datetime',
        ];
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function categories(): BelongsToMany {
        return $this->belongsToMany(Category::class);
    }

    public function scopeSearchTitle(Builder $builder, string $query): void {
        $builder->whereLike('title', '%' . $query . '%');
    }

    public function scopeInCategory(Builder $builder, int $category): void {
        $builder->join('article_category', 'articles.id', '=', 'article_category.article_id')
        ->where('category_id', $category)
        ->select('articles.*');
    }

    public function scopeOrderBySponsored(Builder $builder): void {
        $builder->orderBy('sponsored_untill','desc');
    }
}

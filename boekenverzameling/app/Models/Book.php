<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Book extends Model
{
    /** @use HasFactory<\Database\Factories\BookFactory> */
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'title',
        'author_id',
        'cover_path',
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class);
    }
}

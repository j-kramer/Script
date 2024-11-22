<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;
    use HasUuids;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['user:id,name'];

    protected $fillable = [
        'comment'
    ];

    public function article(): BelongsTo {
        return $this->belongsTo(Article::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}

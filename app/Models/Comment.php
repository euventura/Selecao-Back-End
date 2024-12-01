<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    public $fillable = [
        'user_id',
        'product_id',
        'comment',
        'history'
    ];

    protected $casts = [
        'history' => 'array',
    ];
    use HasFactory;

    /**
     * Return User Relashinship
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function addToHistory()
    {
        $addToHistory = [
            'comment' => $this->comment,
            'changed_at' => $this->updated_at
        ];
        $this->history = array_merge($comment->history ?? [], [$addToHistory]);
        return $this;
    }
}

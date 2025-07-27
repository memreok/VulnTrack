<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'vulnerability_id',
        'user_id',
        'body',
    ];


    public function vulnerability(): BelongsTo
    {
        return $this->belongsTo(Vulnerability::class);
    }



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

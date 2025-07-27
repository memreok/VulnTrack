<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str; // Str sınıfını slug için import ediyoruz

class Tag extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
    ];


    public function vulnerabilities(): BelongsToMany
    {
        return $this->belongsToMany(Vulnerability::class, 'vulnerability_tag');
    }


    protected static function booted(): void
    {
        static::creating(function (Tag $tag) {
            $tag->slug = Str::slug($tag->name);
        });
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tag extends Model
{
    use HasFactory;

    protected $table = "tags";

    /**
     * Get all of the post for the Tag
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function post(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get all of the post_tag for the Tag
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function post_tag(): HasMany
    {
        return $this->hasMany(PostTag::class);
    }
}

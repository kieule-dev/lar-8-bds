<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Property extends Model
{
    use HasFactory;

    protected $table = "properties";

    /**
     * Get all of the comment_property for the Property
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comment_property(): HasMany
    {
        return $this->hasMany(CommentProperty::class);
    }

    /**
     * Get all of the property_image for the Property
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function property_image(): HasMany
    {
        return $this->hasMany(PropertyImage::class);
    }

    /**
     * Get the user that owns the Property
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class,'user_id');
    }

    /**
     * Get all of the message for the Property
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function message(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}

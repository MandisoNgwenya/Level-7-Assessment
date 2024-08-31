<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'posts';
    protected $fillable = [
        'title',
        'body',
        'published',
        'excerpt',
        'description',
        'user_id',
        'thumbnail_id',
        'publish_date'
    ];

    public function tags(): HasMany
    {
        return $this->hasMany(PostTag::class);
    }

    public function thumbnail(): HasOne
    {
        return $this->hasOne(File::class, 'id', 'thumbnail_id');
    }
}

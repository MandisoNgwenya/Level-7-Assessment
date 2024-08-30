<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PostTag extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'post_tags';

    protected $fillable = [
        'post_id',
        'tag_id'
    ];

    public function tag(): HasOne
    {
        return $this->hasOne(Tag::class,'id', 'tag_id');
    }
}

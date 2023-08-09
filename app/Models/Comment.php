<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Comment extends Model
{
    protected $table = "comments";
    protected $primaryKey = "id";
    protected $keyType = "integer";
    public $incrementing = true;

    protected $attributes = [
        "title" => "Sample title",
        "comment" => "Lorem ipsum dolor sit amet."
    ];

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }
}

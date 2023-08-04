<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = "comments";
    protected $primaryKey = "id";
    protected $keyType = "integer";
    public $incrementing = true;

    protected $attributes = [
        "title" => "Sample title",
        "comment"=>"Lorem ipsum dolor, sit amet consectetur adipisicing elit. Alias illum aperiam enim repudiandae maxime, dignissimos eius architecto facilis quam similique? Dignissimos, veniam saepe obcaecati culpa vitae ex nam consectetur ad?
        Fugit, itaque! Placeat unde iste accusantium tempora possimus dolor quo voluptate ut, quas vero sit alias iure repellat, aut cum nostrum sapiente laboriosam in saepe commodi provident reprehenderit necessitatibus minima!"
    ];


}

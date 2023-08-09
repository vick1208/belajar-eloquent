<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Tag extends Model
{
    protected $table = "tags";
    protected $primaryKey = "id";
    protected $keyType = "string";
    public $incrementing = false;
    public $timestamps = false;

    /**
     * products
     *
     * @return MorphToMany
     */
    public function products() : MorphToMany {
        return $this->morphedByMany(Product::class,"taggable");
    }
    /**
     * vouchers
     *
     * @return MorphToMany
     */
    public function vouchers() : MorphToMany {
        return $this->morphedByMany(Voucher::class,"taggable");
    }
}

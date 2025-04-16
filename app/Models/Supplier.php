<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Supplier extends Model {
    protected $fillable = ['name', 'email', 'phone', 'address', 'tax_number'];

    public function products(): BelongsToMany {
        return $this->belongsToMany(Product::class);
    }
}

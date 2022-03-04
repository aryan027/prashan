<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TableTypes extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_type',
        'serving_capacity'
    ];

    /**
     * Getting the tables list relationship.
     *
     * @return HasMany
     */
    public function Tables() {
        return $this->hasMany(Tables::class, 'table_type_id');
    }
}

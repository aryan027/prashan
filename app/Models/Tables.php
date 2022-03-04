<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tables extends Model
{
    use HasFactory;

    protected $fillable = [
        'table_type_id',
        'table_number',
        'status'
    ];

    /**
     * Returning the Relationship
     *
     * @return BelongsTo
     */
    public function TableType() {
        return $this->belongsTo(TableTypes::class, 'table_type_id');
    }

    /**
     * Getting the reservations history of the specific table relationship.
     *
     * @return HasMany
     */
    public function MultiReservations() {
        return $this->hasMany(Bookings::class, 'reserved_table_id');
    }
}

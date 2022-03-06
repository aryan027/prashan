<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bookings extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'booking_date',
        'booking_time',
        'email',
        'phone_no',
        'reserved_table_id',
        'number_of_guests',
        'status'
    ];

    /**
     * Returns the booked table information relationship.
     *
     * @return BelongsTo
     */
    public function ReservedTable() {
        return $this->belongsTo(Tables::class, 'reserved_table_id');
    }

    /**
     * Returns the booked customer information relationship.
     *
     * @return BelongsTo
     */
    public function CustomerInfo() {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}

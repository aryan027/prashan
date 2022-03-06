<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone'
    ];

    /**
     * Getting the booking of the customer relationship.
     *
     * @return HasOne
     */
    public function BookedTable() {
        return $this->hasOne(Bookings::class, 'customer_id');
    }
}

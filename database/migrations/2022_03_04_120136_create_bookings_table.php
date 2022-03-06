<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('booking_date');
            $table->time('booking_time');
            $table->string('email');
            $table->string('phone_no');
            $table->unsignedBigInteger('reserved_table_id');
            $table->foreign('reserved_table_id')->on('tables')->references('id')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('number_of_guests');
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};

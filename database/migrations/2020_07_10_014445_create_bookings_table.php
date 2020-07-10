<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
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
            $table->string('code')->unique();
            $table->integer('client_id');
            $table->integer('employee_id');
            $table->timestamp('booking_date');
            $table->enum('status',['0','1','2'])->default('0');
            $table->string('promo_code')->nullable();
            $table->bigInteger('subtotal')->default(0);
            $table->bigInteger('fees')->default(0);
            $table->bigInteger('discount')->default(0);
            $table->bigInteger('total')->default(0);
            $table->timestamps();
        });
        Schema::create('booking_details', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id');
            // service kind : 0=cut; 1=service, 2=bundle
            $table->enum('kind',['0','1','2'])->default('0');
            $table->integer('child_id');
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
        Schema::dropIfExists('booking_details');
    }
}

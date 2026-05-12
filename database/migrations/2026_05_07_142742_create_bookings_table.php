<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
           $table->id();

        $table->foreignId('car_id')->constrained()->cascadeOnDelete();

        $table->string('customer_name');
        $table->string('email');
        $table->string('phone');

        $table->date('start_date');
        $table->date('end_date');

        $table->integer('total_days');
        $table->decimal('total_price',10,2);

        $table->text('notes')->nullable();

        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};

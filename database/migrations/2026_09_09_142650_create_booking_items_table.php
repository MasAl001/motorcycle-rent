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
        // Create the booking_items table database (populate the data according to the specified ERD diagram)
        Schema::create('booking_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id') // foreign key to the bookings table
                ->constrained('bookings') // parents table is bookings, child table is booking_items, the foreign key is booking_id
                ->cascadeOnDelete(); // cascadeOnDelete() means that if the parent record is deleted, the child record will also be deleted
            $table->foreignId('motor_id') // foreign key to the motors table
                ->constrained('motors') // parents table is motors, child table is booking_items, the foreign key is motor_id
                ->restrictOnDelete(); // restrictOnDelete() means that if the parent record is deleted, the child record will not be deleted, and an error will be thrown
            $table->decimal('price_per_day', 12, 2);
            $table->unsignedInteger('total_days'); // unsignedInteger() means that the value cannot be negative
            $table->decimal('subtotal', 12, 2);
            $table->decimal('deposit', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_items');
    }
};

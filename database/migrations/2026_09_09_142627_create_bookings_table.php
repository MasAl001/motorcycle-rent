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
        // Create the bookings table database (populate the data according to the specified ERD diagram)
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id') // foreign key to the users table
                ->constrained('users') // parents table is users, child table is bookings, the foreign key is user_id
                ->restrictOnDelete(); // restrictOnDelete() means that if the parent record is deleted, the child record will not be deleted, and an error will be thrown
            $table->string('booking_code', 50)->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('pickup_method', ['pickup', 'delivery']);
            $table->text('delivery_address')->nullable();
            $table->decimal('subtotal', 12, 2);
            $table->decimal('delivery_fee', 12, 2)->default(0);
            $table->decimal('discount', 12, 2)->default(0);
            $table->decimal('total_price', 12, 2);
            $table->enum('status', ['pending', 'confirmed', 'rejected', 'cancelled', 'completed'])
                ->default('pending');
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

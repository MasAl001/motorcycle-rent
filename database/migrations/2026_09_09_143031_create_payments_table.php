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
        // Create the payments table database (populate the data according to the specified ERD diagram)
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_id') // foreign key to the bookings table
                ->constrained('bookings') // parents table is bookings, child table is payments, the foreign key is booking_id
                ->cascadeOnDelete(); // cascadeOnDelete() means that if the parent record is deleted, the child record will also be deleted
            $table->string('payment_code', 50)->unique();
            $table->decimal('amount', 12, 2);
            $table->string('payment_method', 50);
            $table->string('payment_proof', 255)->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->enum('status', ['pending', 'paid', 'failed', 'refunded'])
                ->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};

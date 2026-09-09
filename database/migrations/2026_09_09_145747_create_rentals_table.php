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
        // Create the rentals table database (populate the data according to the specified ERD diagram)
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('booking_item_id') // foreign key to the booking_items table
                ->constrained('booking_items') // parents table is booking_items, child table is rentals, the foreign key is booking_item_id
                ->cascadeOnDelete(); // cascadeOnDelete() means that if the parent record is deleted, the child record will also be deleted
            $table->dateTime('pickup_at')->nullable();
            $table->dateTime('due_at')->nullable();
            $table->enum('status', ['scheduled', 'active', 'returned', 'completed'])
                ->default('scheduled');
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};

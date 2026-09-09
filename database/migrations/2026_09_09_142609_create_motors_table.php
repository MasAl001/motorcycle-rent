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
        // Create the motors table database (populate the data according to the specified ERD diagram)
        Schema::create('motors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('motor_category_id') // Foreign key to the motor_categories table
                ->constrained('motor_categories') // parents table is motor_categories, child table is motors, the foreign key is motor_category_id
                ->restrictOnDelete(); // restrictOnDelete() means that if the parent record is deleted, the child record will not be deleted, and an error will be thrown
            $table->string('merk', 100);
            $table->string('color', 100);
            $table->string('model', 100);
            $table->year('year');
            $table->string('plate_number', 20)->unique();
            $table->decimal('price_per_day', 12, 2);
            $table->decimal('deposit', 12, 2);
            $table->text('description')->nullable();
            $table->string('image', 255)->nullable();
            $table->enum('status', ['available', 'rented', 'maintenance', 'inactive'])
                ->default('available');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motors');
    }
};

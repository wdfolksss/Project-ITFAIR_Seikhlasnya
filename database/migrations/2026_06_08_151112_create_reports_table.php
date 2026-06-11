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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            $table->string('reporter_name');
            $table->string('contact');

            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->enum('severity', [
                'ringan',
                'sedang',
                'berat'
            ]);
            
            $table->text('address');

            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);

            $table->text('description');

            $table->string('image');

            $table->foreignId('status_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};

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
        Schema::create('ai_clusters', function (Blueprint $table) {

            $table->id();
            $table->foreignId('report_id');
            $table->integer('severity_score');
            $table->integer('report_count');
            $table->integer('age_days');
            $table->integer('cluster')->nullable();
            $table->double('priority_score')->nullable();
            $table->timestamps();
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('ai_clusters');
    }
};

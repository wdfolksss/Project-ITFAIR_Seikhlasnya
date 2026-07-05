<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('report_timelines', function (Blueprint $table) {
            $table->text('admin_response')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('report_timelines', function (Blueprint $table) {
            $table->dropColumn('admin_response');
        });
    }
};
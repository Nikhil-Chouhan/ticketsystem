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
        Schema::table('tickets_admin', function (Blueprint $table) {
            $table->string('assigned_tester')->nullable()->after('assign_to');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets_admin', function (Blueprint $table) {
            $table->dropColumn('assigned_tester');
        });
    }
};

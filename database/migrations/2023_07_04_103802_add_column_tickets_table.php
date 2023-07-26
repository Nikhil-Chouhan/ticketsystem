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
        Schema::table('tickets', function (Blueprint $table) {
            $table->string('exec_name')->nullable()->after('project_name');
            $table->string('exec_email')->nullable()->after('exec_name');
            $table->string('exec_number')->nullable()->after('exec_email');
            $table->string('issue_type')->nullable()->after('exec_number');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('exec_name');
            $table->dropColumn('exec_email');
            $table->dropColumn('exec_number');
            $table->dropColumn('issue_type');
        });
    }
};

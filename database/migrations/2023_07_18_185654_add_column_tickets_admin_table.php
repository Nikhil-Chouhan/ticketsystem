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
            $table->string('product')->nullable()->after('branch_id');
            $table->string('service')->nullable()->after('product');
            $table->string('support_type')->nullable()->after('service');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets_admin', function (Blueprint $table) {
            $table->dropColumn('product');
            $table->dropColumn('service');
            $table->dropColumn('support_type');
        });
    }
};

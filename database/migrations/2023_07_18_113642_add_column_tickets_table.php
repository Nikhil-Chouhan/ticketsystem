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
            $table->string('branch_id')->after('client_id');
            $table->string('branch_code')->after('branch_id');    
            $table->string('ticket_title')->nullable()->after('ticket_priority');
            $table->string('product')->nullable()->after('project_name');
            $table->string('service')->nullable()->after('product');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('branch_id');
            $table->dropColumn('branch_code');
            $table->dropColumn('ticket_title');
            $table->dropColumn('product');
            $table->dropColumn('service');
        });
    }
};

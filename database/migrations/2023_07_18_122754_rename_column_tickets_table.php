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
            $table->renameColumn('client_id', 'company_id');
            $table->renameColumn('client_name','company_name');
            $table->renameColumn('project_name', 'branch_name');
            $table->renameColumn('ticket_priority','support_type' );
            $table->renameColumn('description','ticket_description' );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->renameColumn('company_id','client_id');
            $table->renameColumn('company_name','client_name');
            $table->renameColumn('branch_name','project_name' );
            $table->renameColumn('support_type','ticket_priority' );
            $table->renameColumn('ticket_description','description');
        });
    }
};

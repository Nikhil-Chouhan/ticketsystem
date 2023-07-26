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
        Schema::create('tickets_admin', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_id');
            $table->string('project_name');
            $table->string('client_id');
            $table->string('client_name');
            $table->string('ticket_lead');
            $table->string('assign_to');
            $table->string('status');
            $table->string('priority');
            $table->string('ticket_raised');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets_admin');
    }
};

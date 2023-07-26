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
        Schema::create('branchmaster', function (Blueprint $table) {
            $table->id();
            $table->string('company_id');
            $table->string('branch_name');
            $table->text('branch_address');
            $table->string('branch_contactperson_name');
            $table->string('branch_contactperson_number');
            $table->string('branch_contactperson_email');
            $table->string('support_type');
            $table->string('product');
            $table->string('service');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('branchmaster');
    }
};

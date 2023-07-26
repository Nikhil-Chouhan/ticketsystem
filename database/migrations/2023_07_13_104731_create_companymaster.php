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
        Schema::create('companymaster', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->text('company_address');
            $table->string('city');
            $table->string('gst_number')->nullable();
            $table->string('contactperson_name');
            $table->string('contactperson_number');
            $table->string('contactperson_email');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companymaster');
    }
};

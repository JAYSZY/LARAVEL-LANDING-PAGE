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
        Schema::create('facility_requests', function (Blueprint $table) {
            $table->id();
            $table->string('facility_name');
            $table->string('region');
            $table->string('contact_name');
            $table->string('position');
            $table->string('contact_number');
            $table->string('email');
            $table->text('message')->nullable();
            $table->enum('status', ['pending', 'contacted', 'approved', 'declined'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facility_requests');
    }
};

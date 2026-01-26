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
        Schema::create('attendee_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('attendee_id')->constrained()->onDelete('cascade');
            $table->foreignId('registration_field_id')->constrained()->onDelete('cascade');
            $table->text('value'); //can be JSON or plain string
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendee_responses');
    }
};

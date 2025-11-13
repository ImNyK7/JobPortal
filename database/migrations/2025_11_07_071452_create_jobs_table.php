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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->string('location')->nullable();
            $table->string('employment_type')->default('Full-time'); // Full-time, Part-time, Internship, etc.
            $table->decimal('salary', 12, 2)->nullable();
            $table->date('deadline')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade'); // HR or Admin who posted the job
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};

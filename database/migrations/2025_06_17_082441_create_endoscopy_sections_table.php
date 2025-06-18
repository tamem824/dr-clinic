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
        Schema::create('endoscopy_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('endoscopy_id')->constrained()->onDelete('cascade');
            $table->foreignId('template_id')->constrained('endoscopy_templates')->onDelete('cascade');
            $table->string('status')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('endoscopy_sections');
    }
};

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
        Schema::create('endoscopy_templates', function (Blueprint $table) {
            $table->id();
            $table->string('type'); // 'upper' أو 'lower'
            $table->string('section_name'); // اسم القسم
            $table->integer('order')->default(0); // لترتيب العرض
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('endoscopy_templates');
    }
};

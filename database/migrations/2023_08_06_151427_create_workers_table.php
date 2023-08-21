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
        Schema::create('workers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('icon_url')->nullable();
            $table->integer('year_of_birth');//سنة الميلاد
            $table->foreignId('work_id')->nullable()->constrained()->nullOnDelete(); // المهنة
            $table->foreignId('country_id')->nullable()->constrained()->nullOnDelete(); // الجنسية
            $table->foreignId('religion_id')->constrained('constants')->nullable(); // الديانة
            $table->json('language')->nullable(); // اللغة
            $table->integer('weight');//الوزن
            $table->integer('height');//الطول
            $table->integer('status')->default(1)->comment('0 => inactive , 1 => active , 2 => booked');
            $table->text('experiences')->nullable();
            $table->text('cv_url')->nullable();
            $table->timestamps();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workers');
    }
};

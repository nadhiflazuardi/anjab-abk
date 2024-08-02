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
    Schema::create('ajuan_unit_kerjas', function (Blueprint $table) {
      $table->id();
      $table->foreignId('ajuan_id')->constrained('ajuan')->cascadeOnDelete();
      $table->foreignId('unit_kerja_id')->constrained('unit_kerja')->cascadeOnDelete();
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('ajuan_unit_kerjas');
  }
};

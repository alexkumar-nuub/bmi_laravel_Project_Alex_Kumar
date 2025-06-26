<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
   // database/migrations/xxxx_create_bmi_records_table.php
public function up()
{
    Schema::create('bmi_records', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->float('weight'); // in kg
        $table->float('height'); // in cm
        $table->string('height_unit'); // 'cm' or 'ft'
        $table->float('bmi_value');
        $table->string('category');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bmi_records');
    }
};

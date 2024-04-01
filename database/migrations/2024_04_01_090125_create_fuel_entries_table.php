<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('fuel_entries', function (Blueprint $table) {
            $table->id();
            $table->string('fuel_type')->nullable();
            $table->string('fuel_price')->nullable();
            $table->string('fuel_amount')->nullable();
            $table->date('fuel_date')->nullable();
            $table->string('kilometers_traveled')->nullable();
            $table->string('oil_type')->nullable();
            $table->string('oil_name')->nullable();
            $table->date('service_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fuel_entries');
    }
};

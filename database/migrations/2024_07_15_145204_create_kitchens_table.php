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
        Schema::create('kitchens', function (Blueprint $table) {
            $table->id();
            $table->string('restaurant_name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('street_address');
            $table->string('city');
            $table->string('postal_code');
            $table->string('state');
            $table->string('phone_number');
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('kitchens');
    }
};

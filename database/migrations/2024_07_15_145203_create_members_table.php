<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('role')->default('member');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('street_address');
            $table->string('city');
            $table->string('postal_code');
            $table->string('state');
            $table->string('phone_number');
            $table->string('password');
            $table->string('caregiver_name')->nullable();
            $table->string('caregiver_phone')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}

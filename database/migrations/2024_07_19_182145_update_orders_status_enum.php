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
        Schema::table('orders', function (Blueprint $table) {
            // Modify the enum type to include new statuses
            $table->enum('status', ['in preparation', 'ready for pickup', 'on its way', 'completed', 'accepted', 'cancelled'])->default('in preparation')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            // Revert to previous enum if needed
            $table->enum('status', ['in preparation', 'ready for pickup', 'on its way', 'completed'])->default('in preparation')->change();
        });
    }
};

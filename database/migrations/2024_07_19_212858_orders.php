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
        Schema::table('orders', function (Blueprint $table) {
            // Modify the enum type to include new statuses
            $table->enum('status', ['pending', 'in preparation', 'ready for pickup', 'on its way', 'completed', 'cancelled'])
                  ->default('pending')
                  ->change();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            // Modify the enum type to include new statuses
            $table->enum('status', ['in preparation', 'ready for pickup', 'on its way', 'completed', 'accepted', 'cancelled'])->default('in preparation')->change();
        });
    }
};

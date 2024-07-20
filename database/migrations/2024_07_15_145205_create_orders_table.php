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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->onDelete('cascade');
            $table->foreignId('kitchen_id')->constrained()->onDelete('cascade');
            $table->foreignId('menu_id')->constrained()->onDelete('cascade');
            $table->foreignId('rider_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('status', ['in preparation', 'ready for pickup','picking up', 'on its way', 'completed'])->default('in preparation');
            $table->boolean('call_upon_arrival')->default(false); // Field for call upon arrival option
            $table->boolean('ring_the_doorbell')->default(false); // Field for ring the doorbell option
            $table->text('notes')->nullable(); // Field for additional order notes
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};

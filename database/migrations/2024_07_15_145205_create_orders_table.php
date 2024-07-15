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
        $table->enum('status', ['in preparation', 'ready for pickup', 'on its way', 'completed'])->default('in preparation');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('orders');
}

};

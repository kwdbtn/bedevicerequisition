<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('device_requests', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->string('device');
            $table->string('model');
            $table->string('specifications')->nullable();
            $table->boolean('device_bought')->default(false);
            $table->string('serial_number')->nullable();
            $table->string('code')->nullable();
            $table->string('status')->nullable();
            $table->datetime('purchase_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('device_requests');
    }0
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('service_requests')) {
            Schema::create('service_requests', function (Blueprint $table) {
                $table->id();
                $table->string('full_name', 200);
                $table->string('email', 255)->nullable();
                $table->string('phone', 50);
                $table->unsignedBigInteger('service_id')->nullable();
                $table->string('service_name', 255)->nullable();
                $table->text('message');
                $table->string('status', 50)->default('pending');
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};

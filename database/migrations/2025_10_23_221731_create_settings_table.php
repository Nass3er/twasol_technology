<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('para')->unique(); // Parameter key (e.g., "Email", "Whatsapp")
            $table->string('para_en')->nullable(); // English label or display name
            $table->string('imagepath')->nullable(); // The stored value]
            $table->text('value')->nullable(); // The stored value]
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};

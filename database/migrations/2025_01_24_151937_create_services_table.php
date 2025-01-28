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
        Schema::create('services', function (Blueprint $table) {
            $table->id(); // id
            $table->unsignedBigInteger('user_id'); // user_id
            $table->string('name'); // name
            $table->text('address')->nullable(); // address
            $table->string('phone')->nullable(); // phone
            $table->string('email')->nullable(); // email
            $table->text('service_description')->nullable(); // service_description
            $table->decimal('rating', 2, 1)->default(0); // rating
            $table->timestamps(); // created_at, updated_at

            // Связь с таблицей users
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};

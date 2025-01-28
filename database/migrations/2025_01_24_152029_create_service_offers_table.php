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
        Schema::create('service_offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_request_id'); // ID заявки
            $table->unsignedBigInteger('service_id'); // ID сервиса, который делает предложение
            $table->decimal('price', 8, 2); // Цена за выполнение услуги
            $table->text('description'); // Описание услуги
            $table->string('status'); // Статус предложения (например, "ожидает", "принято", "отклонено")
            $table->date('date');
            $table->time('time');
            $table->timestamps();

            $table->foreign('service_request_id')->references('id')->on('service_requests')->onDelete('cascade');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_offers');
    }
};

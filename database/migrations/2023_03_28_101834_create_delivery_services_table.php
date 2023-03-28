<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\DeliveryService;

class CreateDeliveryServicesTable extends Migration
{
    public function up(): void
    {
        Schema::create('delivery_services', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->index();
            $table->enum('type', DeliveryService::TYPES);
            $table->decimal('price', 10)->nullable();
            $table->decimal('cost', 10)->nullable();
            $table->string('currency');
            $table->decimal('coefficient')->nullable();
            $table->integer('period')->nullable();
            $table->dateTime('date')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('delivery_services');
    }
}

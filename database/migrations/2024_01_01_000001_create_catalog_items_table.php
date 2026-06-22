<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('catalog_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('category', ['Culinary', 'Kost', 'BRT']);
            $table->unsignedInteger('price');
            $table->string('price_label')->nullable();   // /porsi, /bulan, /trip
            $table->string('image')->nullable();         // path foto upload
            $table->string('short_desc');
            $table->text('description');
            $table->text('facilities');                  // disimpan sebagai JSON
            $table->string('hours');
            $table->string('contact');
            $table->string('address');
            $table->decimal('lat', 10, 7)->default(0);
            $table->decimal('lng', 10, 7)->default(0);
            $table->string('instagram')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('route_code')->nullable();    // khusus BRT
            $table->text('stops')->nullable();           // JSON, khusus BRT
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('catalog_items');
    }
};
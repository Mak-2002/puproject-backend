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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('about')->nullable();

            $table->unsignedInteger('price');
            $table->unsignedInteger('off')->nullable();
            $table->integer('quantity')->default(1);
            $table->integer('people_served')->default(1);

            $table->integer('rating_sum')->default(0);
            $table->integer('rating_count')->default(0);

            $table->string('category');
            $table->foreign('category')->references('name')->on('categories');

            $table->date('availability_start_date')->nullable();
            $table->date('availability_end_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};

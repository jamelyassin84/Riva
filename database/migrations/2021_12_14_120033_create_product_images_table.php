<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductImagesTable extends Migration
{

    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('product_id')
                ->constrained('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('url');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_images');
    }
}

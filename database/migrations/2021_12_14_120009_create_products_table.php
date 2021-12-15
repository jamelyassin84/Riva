<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{

    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('product_name');
            $table->string('image-url');
            $table->string('slug');
            $table->string('brief_description');
            $table->string('description');
            $table->string('currency', 3);
            $table->double('price');
            $table->double('discounted_price');
            $table->string('size_type');
            $table->string('sizes');
            $table->string('colors');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}

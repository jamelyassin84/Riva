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

            $table->string('brief_description')
                ->nullable();

            $table->string('description')
                ->nullable();

            $table->string('currency', 3);

            $table->double('price');

            $table->double('discounted_price')
                ->nullable();

            $table->string('size_type')
                ->nullable();

            $table->integer('sizes')
                ->nullable();

            $table->string('colors')
                ->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}

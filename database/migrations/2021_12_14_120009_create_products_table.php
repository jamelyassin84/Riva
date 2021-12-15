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
            $table->double('price');
            $table->double('discounted_price');
            $table->string('description');
            $table->string('currency', 3);
            $table->string('slug');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}

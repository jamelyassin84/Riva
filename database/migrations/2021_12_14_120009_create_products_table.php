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
            $table->string('image-url')->nullable();
            $table->string('slug')
                ->nullable();
            $table->string('currency', 3);
            $table->double('price');
            $table->string('brief_description')
                ->nullable();

            $table->string('description')
                ->nullable();

            $table->double('discounted_price')
                ->nullable();

            $table->string('variants')
                ->nullable();

            $table->integer('user_id')
                ->foreignIdFor(User::class)
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}

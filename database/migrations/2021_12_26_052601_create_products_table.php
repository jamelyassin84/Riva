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

            $table->integer('user_id')
                ->foreignIdFor(User::class)
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('name');
            $table->string('url');
            $table->string('slug');
            $table->string('currency');
            $table->float('price');
            $table->float('discounted_price');
            $table->string('brief_description');
            $table->string('description', 999);
            $table->string('quantity')->nullable();
            $table->boolean('is_sold_out')->nullable();
            $table->boolean('is_temporary_unavailable')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
}

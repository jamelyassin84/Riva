<?php

use App\Models\Product;
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

            $table->integer('product_id')
                ->foreignIdFor(Product::class)
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('url', 999);
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_images');
    }
}
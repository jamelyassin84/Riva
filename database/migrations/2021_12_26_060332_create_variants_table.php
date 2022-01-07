<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVariantsTable extends Migration
{
    public function up()
    {
        Schema::create('variants', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('product_id')
                ->foreignIdFor(Product::class)
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('name');
            $table->string('value');
        });
    }

    public function down()
    {
        Schema::dropIfExists('variants');
    }
}

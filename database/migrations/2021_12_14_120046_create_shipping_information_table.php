<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShippingInformationTable extends Migration
{

    public function up()
    {
        Schema::create('shipping_information', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('country');

            $table->string('state')
                ->nullable();

            $table->string('city')
                ->nullable();

            $table->string('address_line')
                ->nullable();

            $table->string('zip_code')
                ->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipping_information');
    }
}

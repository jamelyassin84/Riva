<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesTable extends Migration
{
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('iso')->nullable();
            $table->string('name')->nullable();
            $table->string('nice_name')->nullable();
            $table->string('iso3')->nullable();
            $table->string('number_code')->nullable();
            $table->string('phone_code')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('countries');
    }
}

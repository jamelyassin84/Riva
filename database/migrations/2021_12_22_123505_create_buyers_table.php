<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyersTable extends Migration
{
    public function up()
    {
        Schema::create('buyers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('address');
            $table->string('balance');
            $table->string('created');
            $table->string('currency');
            $table->string('default_source');
            $table->string('delinquent');
            $table->string('description');
            $table->string('discount');
            $table->string('email');
            $table->string('buyer_id');
            $table->string('invoice_prefix');
            $table->string('livemode');
            $table->string('metadata');
            $table->string('name');
            $table->string('next_invoice_sequence');
            $table->string('object');
            $table->string('phone');
            $table->string('preferred_locales');
            $table->string('shipping');
            $table->string('tax_exempt');
        });
    }

    public function down()
    {
        Schema::dropIfExists('buyers');
    }
}

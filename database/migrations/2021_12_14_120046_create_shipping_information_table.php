<?php

use App\Models\Product;
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

            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->string('email');
            $table->string('landMark');
            $table->string('mobile');
            $table->string('name');
            $table->string('zipCode');

            $table->string('product_id')
                ->foreignIdFor(Product::class)
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->nullable();

            $table->string('seller')
                ->foreignIdFor(User::class)
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade')
                ->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('shipping_information');
    }
}

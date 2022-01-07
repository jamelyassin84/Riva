<?php

use App\Models\Buyer;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyerInformationTable extends Migration
{

    public function up()
    {
        Schema::create('buyer_information', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('buyer_id')
                ->foreignIdFor(Buyer::class)
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('country');
            $table->string('city');
            $table->string('address');
            $table->string('landmark');
            $table->string('zip_code');
        });
    }

    public function down()
    {
        Schema::dropIfExists('buyer_information');
    }
}

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

            $table->integer('user_id')
                ->foreignIdFor(User::class)
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('buyers');
    }
}

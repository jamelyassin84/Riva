<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCardInfosTable extends Migration
{
    public function up()
    {
        Schema::create('card_infos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('user_id')
                ->foreignIdFor(User::class)
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('method');
            $table->string('card_number')
                ->nullable();

            $table->string('card_type')
                ->nullable();

            $table->string('name_on_card')
                ->nullable();

            $table->string('expiry')
                ->nullable();

            $table->string('cvv')
                ->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('card_infos');
    }
}

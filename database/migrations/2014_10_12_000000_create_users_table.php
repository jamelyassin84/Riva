<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{

    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->rememberToken();
            $table->timestamps();
            $table->string('name');
            $table->string('email')
                ->unique();

            $table->string('password');
            $table->string('phone')
                ->nullable();

            $table->string('alt_phone')
                ->nullable();

            $table->string('avatar')
                ->nullable();

            $table->enum('mode', ['Google', 'Facebook', 'Apple' . 'Default']);


            $table->string('google')
                ->nullable();

            $table->string('facebook')
                ->nullable();


            $table->string('apple')
                ->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}

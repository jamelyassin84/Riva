<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellersTable extends Migration
{
    public function up()
    {
        Schema::create('sellers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('user_id')
                ->foreignIdFor(User::class)
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('stripe_id')->nullable();
            $table->boolean('completed_account_onboarding')->nullable();
            $table->string('avatar')->nullable();
            $table->string('password')->nullable();
            $table->string('mode')->nullable();
            $table->string('google')->nullable();
            $table->string('facebook')->nullable();
            $table->string('apple')->nullable();
            $table->string('verification_code')->nullable();
            $table->float('balance')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sellers');
    }
}

<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesTable extends Migration
{

    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('user_id')
                ->foreignIdFor(User::class)
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('language');
        });
    }


    public function down()
    {
        Schema::dropIfExists('languages');
    }
}

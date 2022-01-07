<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrefferedVariantsTable extends Migration
{
    public function up()
    {
        Schema::create('preferred_variants', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('summary_id')
                ->foreignIdFor(Summary::class)
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('variant_id')
                ->foreignIdFor(Variant::class)
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('preferred_variants');
    }
}

<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecentTransactionsTable extends Migration
{

    public function up()
    {
        Schema::create('recent_transactions', function (Blueprint $table) {
            $table->id();

            $table->timestamps();

            $table->foreignId('product_id')
                ->foreignIdFor(Product::class)
                ->constrained('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('seller')
                ->foreignIdFor(User::class)
                ->constrained('user')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('buyer')
                ->foreignIdFor(User::class)
                ->constrained('user')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->string('currency', 3);

            $table->double('price');

            $table->string('size_type')
                ->nullable();

            $table->integer('sizes')
                ->nullable();

            $table->string('colors')
                ->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('recent_transactions');
    }
}

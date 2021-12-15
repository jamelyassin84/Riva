<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSummariesTable extends Migration
{

    public function up()
    {
        Schema::create('summaries', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('product_id')
                ->foreignIdFor(Product::class)
                ->constrained('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreignId('user_id')
                ->foreignIdFor(User::class)
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('summaries');
    }
}

<?php

use App\Models\Seller;
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

            $table->integer('buyer_id')
                ->foreignIdFor(Buyer::class)
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('seller_id')
                ->foreignIdFor(Seller::class)
                ->constrained('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('product_id')
                ->foreignIdFor(Product::class)
                ->constrained('products')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('amount')->nullable();
            $table->integer('quantity')->nullable();
            $table->string('reference_number');
        });
    }

    public function down()
    {
        Schema::dropIfExists('summaries');
    }
}

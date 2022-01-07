<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankAccountsTable extends Migration
{

    public function up()
    {
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->integer('seller_id')
                ->foreignIdFor(Seller::class)
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->integer('bank_name')->nullable();
            $table->integer('account_name')->nullable();
            $table->integer('iban')->nullable();
            $table->integer('swift')->nullable();
            $table->integer('wallet_balance')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bank_accounts');
    }
}

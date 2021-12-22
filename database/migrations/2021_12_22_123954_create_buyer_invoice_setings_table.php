<?php

use App\Models\Buyers;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBuyerInvoiceSetingsTable extends Migration
{

    public function up()
    {
        Schema::create('buyer_invoice_setings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('custom_fields');
            $table->string('default_payment_method');
            $table->string('footer');
            $table->string('buyer_id')
                ->foreignIdFor(Buyers::class)
                ->onUpdate('cascade')
                ->onDelete('cascade');;
        });
    }


    public function down()
    {
        Schema::dropIfExists('buyer_invoice_settings');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentConfirmationsTable extends Migration
{
    public function up()
    {
        Schema::create('payment_confirmations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade');
            $table->string('bank_name');
            $table->string('account_name');
            $table->decimal('transfer_amount', 15, 2);
            $table->date('transfer_date');
            $table->string('payment_proof');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('payment_confirmations');
    }
}


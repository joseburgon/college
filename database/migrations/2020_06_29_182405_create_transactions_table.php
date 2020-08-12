<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('type', 50)->nullable();
            $table->string('paypal_order', 250)->nullable();
            $table->string('status', 100)->nullable();
            $table->string('status_detail', 100)->nullable();
            $table->string('payment_method_id', 100)->nullable();
            $table->string('payment_type_id', 100)->nullable();
            $table->string('operation_type', 100)->nullable();
            $table->string('description', 250)->nullable();
            $table->string('external_reference', 50)->nullable();
            $table->string('currency_id', 10)->nullable();
            $table->bigInteger('coupon_amount')->nullable();
            $table->float('net_amount', 8, 2)->nullable();
            $table->float('transaction_amount', 8, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}

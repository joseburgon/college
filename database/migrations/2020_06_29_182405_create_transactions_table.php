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
            $table->bigInteger('merchant_id')->nullable();
            $table->string('state_pol', 32)->nullable();
            $table->decimal('risk', 8, 2)->nullable();
            $table->string('response_code_pol', 255)->nullable();
            $table->string('reference_sale', 255)->nullable();
            $table->string('reference_pol', 255)->nullable();
            $table->string('sign', 255)->nullable();
            $table->string('extra1', 255)->nullable();
            $table->string('extra2', 255)->nullable();
            $table->bigInteger('payment_method')->nullable();
            $table->bigInteger('payment_method_type')->nullable();
            $table->bigInteger('installments_number')->nullable();
            $table->decimal('value', 14, 2)->nullable();
            $table->decimal('tax', 14, 2)->nullable();
            $table->decimal('additional_value', 14, 2)->nullable();
            $table->date('transaction_date')->nullable();
            $table->string('currency', 3)->nullable();
            $table->string('email_buyer', 255)->nullable();
            $table->string('cus', 64)->nullable();
            $table->string('pse_bank', 255)->nullable();
            $table->boolean('test', 255)->nullable();
            $table->string('description', 255)->nullable();
            $table->string('billing_address', 255)->nullable();
            $table->string('shipping_address', 50)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('office_phone', 20)->nullable();
            $table->string('account_number_ach', 36)->nullable();
            $table->string('account_type_ach', 36)->nullable();
            $table->decimal('administrative_fee', 8, 2)->nullable();
            $table->decimal('administrative_fee_base', 8, 2)->nullable();
            $table->decimal('administrative_fee_tax', 8, 2)->nullable();
            $table->string('airline_code', 4)->nullable();
            $table->integer('attempts')->nullable();
            $table->string('authorization_code', 12)->nullable();
            $table->string('bank_id', 255)->nullable();
            $table->string('billing_city', 255)->nullable();
            $table->string('billing_country', 2)->nullable();
            $table->decimal('commision_pol', 8, 2)->nullable();
            $table->string('commision_pol_currency', 3)->nullable();
            $table->bigInteger('customer_number')->nullable();
            $table->date('date')->nullable();
            $table->string('error_code_bank', 255)->nullable();
            $table->string('error_message_bank', 255)->nullable();
            $table->decimal('exchange_rate', 8, 2)->nullable();
            $table->string('ip', 39)->nullable();
            $table->string('nickname_buyer', 150)->nullable();
            $table->string('nickname_seller', 150)->nullable();
            $table->bigInteger('payment_method_id')->nullable();
            $table->string('payment_request_state', 32)->nullable();
            $table->string('pseReference1', 255)->nullable();
            $table->string('pseReference2', 255)->nullable();
            $table->string('pseReference3', 255)->nullable();
            $table->string('response_message_pol', 255)->nullable();
            $table->string('shipping_city', 50)->nullable();
            $table->string('shipping_country', 20)->nullable();
            $table->string('transaction_bank_id', 255)->nullable();
            $table->string('transaction_id', 36)->nullable();
            $table->string('payment_method_name', 255)->nullable();
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

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->date('date')->nullable();
            $table->string('description');
            $table->timestamps();
        });

        Schema::connection('tenant')->create('transaction_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transaction_id')->index();
            $table->integer('account_id')->index();
            $table->decimal('debit', 18, 2)->default(0);
            $table->decimal('credit', 18, 2)->default(0);
            $table->integer('reference_id')->index()->nullable();
            $table->integer('weight')->default(0);
            $table->enum('ref_type', ['none', 'company', 'customer'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::connection('tenant')->drop('transaction_details');
        Schema::connection('tenant')->drop('transactions');
    }
}

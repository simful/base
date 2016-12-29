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
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->index();
            $table->date('date')->nullable();
            $table->string('description');
            $table->timestamps();
        });

        Schema::create('transaction_details', function (Blueprint $table) {
            $table->integer('transaction_id')->index();
            $table->integer('account_id')->index();
            $table->decimal('debit', 18, 2)->default(0);
            $table->decimal('credit', 18, 2)->default(0);
            $table->integer('reference_id')->index()->nullable();
            $table->enum('ref_type', ['none', 'company', 'customer'])->nullable();

            $table->primary(['transaction_id', 'account_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('transaction_details');
        Schema::drop('transactions');
    }
}

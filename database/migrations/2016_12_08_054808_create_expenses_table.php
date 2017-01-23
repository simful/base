<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('expenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_id')->nullable();
            $table->integer('user_id')->index();
            $table->integer('source_account_id')->nullable();
            $table->integer('expense_account_id');
            $table->date('date')->nullable();
            $table->string('reference_number')->nullable();
            $table->date('due_date')->nullable();
            $table->boolean('paid')->default(false);
            $table->string('payment_method')->nullable();
            $table->string('description')->nullable();
            $table->decimal('amount', 18, 2)->default(0);
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
        Schema::connection('tenant')->drop('expenses');
    }
}

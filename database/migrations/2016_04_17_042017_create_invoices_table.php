<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->index();
            $table->integer('user_id')->index();
            $table->date('date')->nullable();
            $table->date('due_date');
            $table->enum('status', ['Draft', 'Sent', 'In Progress', 'Shipping', 'Completed', 'Canceled'])->default('Draft');
            $table->string('notes')->nullable();
            $table->decimal('amount_paid', 18, 2)->default(0);
            $table->boolean('paid')->default(false);
            $table->boolean('stock_updated')->default(false);
            $table->boolean('recurring')->default(false);
            $table->integer('recur_every')->default(30);
            $table->timestamps();
        });

        Schema::connection('tenant')->create('invoice_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id')->index();
            $table->integer('product_id')->nullable();
            $table->string('description')->nullable();
            $table->integer('qty')->default(1);
            $table->decimal('price', 18, 2)->default(0);
            $table->decimal('price_nett', 18, 2)->default(0);
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
        Schema::connection('tenant')->drop('invoice_details');
        Schema::connection('tenant')->drop('invoices');
    }
}

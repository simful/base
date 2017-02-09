<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('purchases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_id')->index();
            $table->integer('user_id')->index();
            $table->date('date')->nullable();
            $table->string('type')->nullable();
            $table->string('reference_number')->nullable();
            $table->date('due_date')->nullable();
            $table->date('limit')->nullable();
            $table->enum('status', ['Draft', 'Sent', 'In Progress', 'Shipping', 'Completed', 'Canceled'])->default('Draft');
            $table->boolean('paid')->default(false);
            $table->boolean('stock_updated')->default(false);
            $table->string('payment_method')->default('Cash');
            $table->string('notes')->nullable();
            $table->decimal('amount_paid', 18, 2)->default(0);
            $table->timestamps();
        });

        Schema::connection('tenant')->create('purchase_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('purchase_id')->index();
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
        Schema::connection('tenant')->drop('purchases');
        Schema::connection('tenant')->drop('purchase_details');
    }
}

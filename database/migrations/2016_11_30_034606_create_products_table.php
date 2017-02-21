<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('products', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type', ['Product', 'Service'])->default('Product');

            // default buy and sell price
            $table->decimal('buy_price', 18, 2)->default(0);
            $table->decimal('sell_price', 18, 2)->default(0);

            // average buy price
            $table->decimal('avg_buy_price', 18, 2)->default(0);

            // current stock
            $table->integer('stock')->default(0);

            // restock treshold
            $table->integer('restock_treshold')->default(5);
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
        Schema::connection('tenant')->drop('products');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::connection('tenant')->create('refunds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('invoice_id')->index();
            $table->decimal('amount', 18, 2);
            $table->decimal('refund_fee', 18, 2)->default(0);
            $table->text('reason')->nullable();
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
        Schema::connection('tenant')->drop('refunds');
    }
}

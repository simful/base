<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('letter_guarantees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('supplier_id')->index();
            $table->date('date')->nullable();
            $table->string('number')->nullable();
            $table->string('ref_number')->nullable();
            $table->text('remarks')->nullable();
            $table->timestamps();
        });

        Schema::create('letter_guarantee_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('letter_id')->index();
            $table->text('description');
            $table->decimal('price', 18, 2);
            $table->string('currency', 3)->default('IDR');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('letter_guarantee_details');
        Schema::drop('letter_guarantees');
    }
}

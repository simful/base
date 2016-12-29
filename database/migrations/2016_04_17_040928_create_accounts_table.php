<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->integer('account_group_id')->index();
            $table->string('name');
            $table->string('currency', 3)->default('IDR');
            $table->boolean('has_reference')->default(false);
            $table->boolean('is_locked')->default(false);
            $table->boolean('is_header')->default(false);
            $table->timestamps();
        });

        Schema::create('account_groups', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('name');
            $table->enum('type', ['Permanent', 'Temporary']);
            $table->enum('position', ['Debit', 'Credit']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('account_groups');
        Schema::drop('accounts');
    }
}

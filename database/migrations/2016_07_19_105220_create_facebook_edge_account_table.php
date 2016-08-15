<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacebookEdgeAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facebook_edge_account', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('edge_id');
            $table->integer('account_id');
            $table->timestamps();
            $table->foreign('edge_id')->references('id')->on('facebook_edges');
            $table->foreign('account_id')->references('id')->on('facebook_accounts');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('facebook_edge_account');
    }
}

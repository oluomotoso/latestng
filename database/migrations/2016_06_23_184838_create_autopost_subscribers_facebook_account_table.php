<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAutopostSubscribersFacebookAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('autopost_subscribers_facebook_account', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subscriber_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('token')->nullable();
            $table->string('refresh_token')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook_id')->nullable();
            $table->dateTime('token_expiry')->nullable();
            $table->timestamps();
            $table->foreign('subscriber_id')->references('id')->on('autopost_subscribers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('autopost_subscribers_facebook_account');
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaggedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tagged', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tags_id')->unsigned();
            $table->integer('news_feed_id');
            $table->foreign('tags_id')->references('id')->on('tags');
            $table->foreign('news_feed_id')->references('id')->on('news_feed');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tagged');
    }
}

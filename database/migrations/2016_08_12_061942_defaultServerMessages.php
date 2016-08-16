<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DefaultServerMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('default_server_messages', function (Blueprint $table){
        	$table->increments('id');
        	$table->string('url_param');
	        $table->text('css');
	        $table->text('css_class_name');
	        $table->string('message_box_name');
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
        Schema::drop('default_server_messages');
    }
}

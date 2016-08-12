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
        	$table->string('urlParam');
	        $table->text('css');
	        $table->string('messageBoxName');
	        $table->string('cssClassName');
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

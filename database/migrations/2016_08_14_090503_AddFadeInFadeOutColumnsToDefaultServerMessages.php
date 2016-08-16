<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFadeInFadeOutColumnsToDefaultServerMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table("default_server_messages", function (Blueprint $table){
        	$table->addColumn('boolean', 'fade_out');
	        $table->addColumn('boolean', 'fade_in');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table("default_server_messages", function (Blueprint $table){
		    $table->removeColumn('fade_out');
		    $table->addColumn('fade_in');
	    });
    }
}

<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeDefaultServerMessagesColumnNames extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

	    Schema::table('default_server_messages', function (Blueprint $table) {
		    $table->renameColumn('urlParam', 'url_param');
		    $table->renameColumn('messageBoxName', 'message_box_name');
		    $table->renameColumn('cssClassName', 'css_class_name');
	    });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
	    Schema::table('default_server_messages', function (Blueprint $table) {
		    $table->renameColumn('url_param', 'urlParam');
		    $table->renameColumn('message_box_name', 'messageBoxName');
		    $table->renameColumn('css_class_name', 'cssClassName');
	    });
    }
}

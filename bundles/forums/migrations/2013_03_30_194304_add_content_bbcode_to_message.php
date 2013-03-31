<?php

class Forums_Add_Content_Bbcode_To_Message {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('forummessages', function($table) {
			$table->text('content_bbcode');
		});

	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('forummessages', function($table) {
			$table->drop_column('content_bbcode');
		});
	}

}
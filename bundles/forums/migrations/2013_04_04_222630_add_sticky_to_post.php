<?php

class Forums_Add_Sticky_To_Post {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('forumtopics', function($table) {
			$table->boolean('sticky')->index();
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('forumtopics', function($table) {
			$table->drop_index('sticky');
			$table->drop_column('sticky');
		});
	}

}
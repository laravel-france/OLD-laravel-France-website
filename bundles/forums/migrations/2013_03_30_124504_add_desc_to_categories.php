<?php

class Forums_Add_Desc_To_Categories {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('forumcategories', function($table) {
			$table->text('desc')->nullable();
		});

	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('forumcategories', function($table) {
			$table->drop_column('desc');
		});

	}
}
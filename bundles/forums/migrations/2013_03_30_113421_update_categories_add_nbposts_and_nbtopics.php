<?php

class Forums_Update_Categories_Add_Nbposts_And_Nbtopics {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('forumcategories', function($table) {
			$table->integer('nb_topics')->unsigned();
			$table->integer('nb_posts')->unsigned();
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
			$table->drop_column('nb_posts');
			$table->drop_column('nb_topics');
		});

	}

}
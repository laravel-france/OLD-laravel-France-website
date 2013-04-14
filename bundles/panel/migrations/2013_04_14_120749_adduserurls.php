<?php

class Panel_Adduserurls {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('users', function($table)
		{
			$table->string('twitter_url')->nullable();
			$table->string('github_url')->nullable();
			$table->string('googleplus_url')->nullable();
		});

	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table)
		{
			$table->drop_column('twitter_url');
			$table->drop_column('github_url');
			$table->drop_column('googleplus_url');
		});
	}

}
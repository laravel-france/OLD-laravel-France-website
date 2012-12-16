<?php

class Blog_Add_Intro_To_Posts {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::query('ALTER TABLE `posts` ADD COLUMN `intro` TEXT NULL  AFTER `slug`;');
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
        DB::query('ALTER TABLE `posts` DROP COLUMN `intro` ;');
	}

}
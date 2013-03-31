<?php

class Forums_Create_Forums_Categories_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('forumcategories', function($table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('title');
            $table->string('slug')->unique();

            $table->integer('order')->unsigned();

            $table->timestamps();
        });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('forumscategories');
	}

}
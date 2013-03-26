<?php

class Blog_Create_Category {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('categories', function($table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('name');
            $table->string('slug')->unique();

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
		Schema::drop('categories');
	}

}
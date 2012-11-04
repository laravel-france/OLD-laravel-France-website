<?php

class Blog_Create_Table_User {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('username');
            $table->string('email')->unique();
            $table->string("password", 64);
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
		Schema::drop('users');
	}

}
<?php

class Blog_Create_Table_Posts {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('posts', function($table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content');

            $table->integer('author_id')->unsigned();
            $table->integer('category_id')->unsigned();
            
            $table->foreign('author_id')->references('id')->on('users')->on_update('CASCADE')->on_delete('RESTRICT');
            $table->foreign('category_id')->references('id')->on('categories')->on_update('CASCADE')->on_delete('RESTRICT');

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
		Schema::drop('posts');
	}

}
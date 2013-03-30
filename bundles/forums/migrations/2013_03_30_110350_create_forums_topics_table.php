<?php

class Forums_Create_Forums_Topics_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('forumtopics', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('title');
            $table->string('slug')->unique();

            $table->integer('nb_messages')->unsigned();
            $table->integer('nb_views')->unsigned();

			$table->integer('forumcategory_id')->unsigned()->foreign()->references('id')->on('forumcategories')->on_delete('SET NULL')->on_update('cascade');
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
        Schema::drop('forumtopics');
	}

}
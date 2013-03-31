<?php

class Forums_Create_Forums_Messages_Table {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('forummessages', function($table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->text('content');

			$table->integer('user_id')->unsigned()->foreign()->references('id')->on('users')->on_delete('SET NULL')->on_update('cascade');
			$table->integer('forumtopic_id')->unsigned()->foreign()->references('id')->on('forumtopics')->on_delete('SET NULL')->on_update('cascade');

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
		Schema::drop('forummessages');
	}

}
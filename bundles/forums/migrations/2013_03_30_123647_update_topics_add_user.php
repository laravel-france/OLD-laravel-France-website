<?php

class Forums_Update_Topics_Add_User {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('forumtopics', function($table) {
			$table->integer('user_id')->unsigned()->foreign()->references('id')->on('users')->on_delete('SET NULL')->on_update('cascade');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function forumtopics()
	{
       Schema::table('forumtopics', function($table)
        {
            $table->drop_foreign('forumtopics_user_id_foreign');
            $table->drop_column('user_id');
        });
	}

}
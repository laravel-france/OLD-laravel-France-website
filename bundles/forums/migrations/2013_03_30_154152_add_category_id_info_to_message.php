<?php

class Forums_Add_Category_Id_Info_To_Message {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('forummessages', function($table) {
			$table->integer('forumcategory_id')->unsigned()->foreign()->references('id')->on('forumcategories')->on_delete('SET NULL')->on_update('cascade');
		});


	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
       Schema::table('forummessages', function($table)
        {
            $table->drop_foreign('forummessages_forumcategory_id_foreign');
            $table->drop_column('forumcategory_id');
        });

	}

}
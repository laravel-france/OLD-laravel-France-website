<?php

class Blog_Add_Category_To_Post {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('posts', function($table) {

			$table->integer('category_id')->unsigned()->foreign()->references('id')->on('categories')->on_delete('restrict')->on_update('cascade');
		});
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		$table->drop_foreign('posts_category_id_foreign');
		$table->drop_column('category_id');
	}

}
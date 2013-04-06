<?php

class Add_Roles_Basic_Roles_To_Db {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
		DB::table('roles')->insert(array(
			'name' => 'Forumer',
			'level' => '5',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		));

		DB::table('roles')->insert(array(
			'name' => 'Blogger',
			'level' => '5',
			'created_at' => date('Y-m-d H:i:s'),
			'updated_at' => date('Y-m-d H:i:s'),
		));
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
		DB::table('roles')->where('name', '=', 'Blogger')->delete();
		DB::table('roles')->where('name', '=', 'Forumer')->delete();
	}

}
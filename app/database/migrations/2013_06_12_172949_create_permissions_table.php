<?php

use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Create the 'Permissions' table
		Schema::create('permissions', function($table)
		{
			$table->increments('id')->unsigned();
			$table->string('name');
			$table->string('description');
			$table->unique('name');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Delete the 'Permissions' table
		Schema::drop('permissions');
	}

}

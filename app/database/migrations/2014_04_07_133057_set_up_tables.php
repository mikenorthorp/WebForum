<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetUpTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Set up a users table
		Schema::create('users', function($table)
		{
			// Set up user table with id, username, password, and email.
			$table->increments('id');
			$table->string('username', 50);
			$table->string('password', 255);
			$table->string('email', 255);
			$table->timestamps();
		});

		// Set up a topics table
		Schema::create('topics', function($table)
		{
			// Set up topics table with id, topic name, and description
			$table->increments('id');
			$table->string('topic_name', 255);
			$table->string('topic_desc', 255);
			$table->timestamps();
		});

		// Set up a replies table
		Schema::create('replies', function($table)
		{
			// Add a reply id, a topic id for the topic, and a 
			// created by id to link to user. Also set up timestamps 
			// columns
			$table->increments('id');
			$table->string('reply_content', 255);
			$table->bigInteger('topic_id');
			$table->bigInteger('created_by');
			// Adds created at and updated at columns
			$table->timestamps();
		});

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('users');
		Schema::drop('topics');
		Schema::drop('replies');
	}

}

<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();
		// Seed the user table
		$this->call('UserTableSeeder');
		$this->command->info('User table seeded!');

		// Seed the topics table
		$this->call('TopicsTableSeeder');
		$this->command->info('User table seeded!');

		// See the replies table
		$this->call('RepliesTableSeeder');
		$this->command->info('User table seeded!');
	}

}

// Create an initial admin user for the database
class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        // Create an initial user named admin, with pass admin and an email
        User::create(array(
        	'username' => 'admin',
        	'password' => Hash::make('admin'),
        	'email' => 'admin@noreply.com'
        ));
    }
}

// Create an initial topic seed
class TopicsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('topics')->delete();

        // Create initial topic and description
        Topics::create(array(
        	'topic_name' => 'Has Science Gone Too Far?',
        	'topic_desc' => 'Discuss why science is doing bad things..',
        ));
    }
}

// Create an initial replies seed
class RepliesTableSeeder extends Seeder {

    public function run()
    {
        DB::table('replies')->delete();

        // Create an initial post and link to user id 1 and topic 1
        Replies::create(array(
        	'reply_content' => 'I think it hasnt gone far enough!',
        	'topic_id' => 1,
        	'created_by' => 1,
        ));
    }
}
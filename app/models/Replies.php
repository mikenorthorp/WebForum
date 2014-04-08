<?php

// Set up replies to be linked to the DB and use the eloquent methods
class Replies extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'replies';
}
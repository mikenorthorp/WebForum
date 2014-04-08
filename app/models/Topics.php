<?php

// Set up topics to be linked to DB and extend the eloquent methods
class Topics extends Eloquent {
	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'topics';
}
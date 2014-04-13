<?php

class Location extends AppModel
{
	/**
	 * Standard validation behaviour
	 */
	public $belongsTo = 'Tour';
	
	var $validate = array(
	
		'tour_id' => array(
		),
	);
	
}
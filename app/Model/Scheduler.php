<?php

class Scheduler extends AppModel
{
	/**
	 * Standard validation behaviour
	 */
	public $belongsTo = array('User', 'Product');
	
	var $validate = array(
	
		'user_id' => array(
		),
		'tour_id' => array(
		),
	);
	
}
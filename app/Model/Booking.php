<?php

class Booking extends AppModel
{
	/**
	 * Standard validation behaviour
	 */
	public $belongsTo = array('User', 'Product');
	
	var $validate = array(
	
		'user_id' => array(
		),
		'product_id' => array(
		),
	);
	
}
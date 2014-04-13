<?php

class MyTrip extends AppModel
{
	/**
	 * Standard validation behaviour
	 */
	var $actsAs = array ('Containable');
	
	public $belongsTo = array('Product');
	
	var $validate = array(
	
		'product_id' => array(
		),
	);
	
}
<?php

class Category extends AppModel
{

	var $actsAs = array('Containable');
	/**
	 * Standard validation behaviour
	 */
	public $hasMany = array(
		'Product', 'SubCategory'
	);
	
	var $validate = array(
		'name' => array(
			'length' => array(
				'rule'      => array('notEmpty'),
				'message'   => 'Please enter valid name',
				'required'  => true,
			),
		),
	);
	
}
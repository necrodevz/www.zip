<?php

class Admin extends AppModel
{
	//public $hasMany = array('Image');
	
	
	var $validate = array(
/* 		'first_name' => array(
			'length' => array(
				'rule'      => array('notEmpty','minLength', 2),
				'message'   => 'Please enter your first name (more than 2 chars)',
				'required'  => true,
			),
		),
		'last_name' => array(
			'length' => array(
				'rule'      => array('notEmpty','minLength', 2),
				'message'   => 'Please enter your last name (more than 2 chars)',
				'required'  => true,
			),
		), */
		'email' => array(
			'email' => array(
				'rule'      => array('notEmpty','email'),
				'message'   => 'Must be a valid email address',
			),
			'unique' => array(
				'rule'      => 'isUnique',
				'message'   => 'Already taken',
			),
		),
		'password' => array(
			'empty' => array(
				'rule'      => 'notEmpty',
				'message'   => 'Must not be blank',
				'required'  => true,
			),
		),
		'password_confirm' => array(
			'compare'    => array(
				'rule'      => array('password_match', 'password', false),
				'message'   => 'The password you entered does not match',
				'required'  => true,
			),
			'length' => array(
				'rule'      => array('between', 6, 20),
				'message'   => 'Use between 6 and 20 characters',
			),
			'empty' => array(
				'rule'      => 'notEmpty',
				'message'   => 'Must not be blank',
			),
		),
	);
	
}
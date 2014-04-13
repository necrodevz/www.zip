<?php

App::uses('AuthComponent', 'Controller/Component', 'Email');

class User extends AppModel
{
	/**
	 * Standard validation behaviour
	 */
	public $hasOne = array('Profile', 'Contact');
	public $hasMany = array('Product', 'MyTrip');
	
	var $validate = array(
		'first_name' => array(
			'length' => array(
				'rule'      => array('notEmpty','minLength', 2),
				'message'   => 'Please enter your name (more than 2 chars)',
				'required'  => true,
			),
		),
		'last_name' => array(
			'length' => array(
				'rule'      => array('notEmpty','minLength', 2),
				'message'   => 'Please enter your name (more than 2 chars)',
				'required'  => true,
			),
		),
		'middle_name' => array(
			'length' => array(
				'rule'      => array('minLength', 2),
				'message'   => 'Please enter your last name (more than 2 chars)',
				'required'  => false,
			),
		),
		'title' => array(
			'length' => array(
				'rule'      => array('inList', array('mr', 'miss', 'mrs')),
				'message'   => 'Please enter your title',
				'required'  => false,
			),
		),
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

	
	public function beforeSave($options = array()) {
		if (isset($this->data[$this->alias]['password'])) {
			$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
		}
		return true;
	}

	/**
	 * Extra form dependent validation rules
	 */
	var $validateChangePassword = array(
		'_import' => array('password', 'password_confirm'),
		'password_old' => array(
			'correct' => array(
				'rule'      => 'password_old',
				'message'   => 'Does not match',
				'required'  => true,
			),
			'empty' => array(
				'rule'      => 'notEmpty',
				'message'   => 'Must not be blank',
			),
		),
	);
	
	var $validateUserGeneralInfo = array(
		'_import' => array('first_name', 'last_name', 'middle_name', 'title'),
	);

	/**
	  * Hold the current logged in user during change of password
	  */
	var $current_user_id;

	/**
	 * Dynamically adjust our validation behaviour
	 *
	 * Look for an _import key in new ruleset, and import
	 * those rules from the base validation ruleset
	 *
	 * @param   string  array key of the validation ruleset to use
	 */
	function useValidationRules($key)
	{
		$variable = 'validate' . $key;
		$rules = $this->$variable;

		if (isset($rules['_import'])) {
			foreach ($rules['_import'] as $key) {
				$rules[$key] = $this->validate[$key];
			}
			unset($rules['_import']);
		}

		$this->validate = $rules;
	}

	/**
	 * Ensure password matches the user session
	 *
	 * @param   array   data provided by the controller
	 */
	function password_old($data)
	{
		$password = $this->field('password',
			array('User.id' => $this->current_user_id));
		//debug($this);
		return $password ===
			Security::hash($data['password_old'], null, true);
	}

	/**
	 * Ensure two password fields match
	 *
	 * @param   array   data provided by the controller
	 * @param   string  the original (already hashed) password fieldname
	 * @param   bool    whether the password field has been hashed,
	 *                  only hashed when a username input is present
	 */
	function password_match($data, $password_field, $hashed = true)
	{
		$password  = $this->data[$this->alias][$password_field];
		$keys = array_keys($data);
		$password_confirm = $hashed ?
			  AuthComponent::password($data[$keys[0]], null, true) :
			  $data[$keys[0]];
		return $password === $password_confirm;
	}
	
	/**
	 * Generate a random pronounceable password
	 */
	function generatePassword($length = 10) {
		// Seed
		srand((double) microtime()*1000000);
		
		$vowels = array('a', 'e', 'i', 'o', 'u');
		$cons = array('b', 'c', 'd', 'g', 'h', 'j', 'k', 'l', 'm', 'n',
			'p', 'r', 's', 't', 'u', 'v', 'w', 'tr',
			'cr', 'br', 'fr', 'th', 'dr', 'ch', 'ph',
			'wr', 'st', 'sp', 'sw', 'pr', 'sl', 'cl');
		
		$num_vowels = count($vowels);
		$num_cons = count($cons);
		
		$password = '';
		for ($i = 0; $i < $length; $i++){
			$password .= $cons[rand(0, $num_cons - 1)] . $vowels[rand(0, $num_vowels - 1)];
		}
		
		return substr($password, 0, $length);
	}   
}

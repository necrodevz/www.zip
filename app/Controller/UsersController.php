<?php
class UsersController extends AppController
{
	var $components = array('Email', 'Facebook.Connect');
	var $name = 'Users';
	/**
	 * Runs automatically before the controller action is called
	 */
	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('register', 'recover', 'verify', 'verify_email', 'need_verify_email', 'login', 'logout', 'fbauth', array('controller'=>'pages', 'action'=>'home'));
		
		if($this->Auth->user('role') == 'user') { 
			$this->Auth->allow('index', 'account', 'home');
		}
	}

	public function index()
	{
      $this->redirect(array('controller'=>'mytrips', 'action'=>'index'));
		//print_r($current_user);
		
		
	}

	/**
	 * Registration page for new users
	 */
	function register()
	{
		
		if ($this->Auth->user()) {
			$this->redirect(array('controller' => 'users', 'action' => 'index'));
		}
			
		if ($this->request->is('post')) {
			if (!empty($this->request->data)) {
			
				$this->request->data['User']['verified'] = false;
			
				$this->User->create();
				if ($this->User->save($this->request->data['User'])) {
					if($this->User->id)
					{
						//$this->request->data['Profile']['user_id'] = $this->User->id;
						//$this->User->Profile->save($this->request->data['Profile']);
						
						//send user verification email
						$Token = ClassRegistry::init('Token');
						$user = $this->User->findById($this->User->id);

						if ($user == NULL) 
						{
							$this->Session->setFlash('No matching user found');
							return false;
						}

						$token = $Token->generate(array('User' => $user['User']));
						
						$Email = new CakeEmail();
						// Send email with new password
						$Email->to($user['User']['email'])
							->config('smtp')
							->subject('Email Verification')
							->from('no-reply@discoverpost.com')
							->template('email_verify')
							->viewVars(array('user' => $user, 'token' => $token))
							->emailFormat('html');
							
						try
						{
							$Email->send();
							$this->Session->setFlash('A verification email has been sent to your account, please follow the instructions in this email.');
						}
						catch(Exception $e)
						{
							$this->_f('An error occurred while sending verification email.', 'flash_error');
						}
					}
					$this->_f('Your account has been created');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->_f('Your account could not be created. Please, try again.', 'flash_error');
				}
				//debug($this->User->validationErrors);
			}
		}
		
		//$this->layout = 'frontpage';
	}
	
	function fbauth()
	{
		// Check for a successful login
		if ($this->Auth->user()) {
			$this->redirect(array('controller' => 'users', 'action' => 'index'));
		}
		
		if($user = $this->Connect->registrationData()){
			print_r($user);
		}
	}

	/**
	 * Ran directly after the Auth component has executed
	 */
	function login()
	{
		// Check for a successful login
		if ($this->Auth->user()) {
			$this->redirect(array('controller' => 'mytrips', 'action' => 'index'));
		}
		
		//$this->layout = 'frontpage';
		
		if ($this->request->is('post') && !empty($this->request->data)) {
		
			if ($this->Auth->login()) {
				$id = $this->Auth->user('id');
				
				//set the user source
				$this->User->setSource($this->Auth->user('role').'s');
		
				// Set the lastlogin time
				$this->User->id = $id;
				
				$this->User->saveField('lastlogin', date('Y-m-d H:i:s'));
					
				$this->_f('Welcome Back !');

				// Redirect the user to home
				$url = '/home';
				
				if ($this->Session->check('Auth.redirect')) {
					$url = $this->Session->read('Auth.redirect');
				}
				$this->redirect($url);
				
			} else {
				$this->_f('Invalid email or password, try again', 'flash_error');
			}
		}
		
		$this->layout = 'homepage';
	}

	/**
	 * Log a user out
	 */
	function logout()
	{
	   $this->_f('Logged out!', 'flash_error');
	   return $this->redirect($this->Auth->logout());
	}
	
	/**
	 * Account details page (change password)
	 */
	function account()
	{
		//set the user source
		$this->User->setSource($this->Auth->user('role').'s');

		$this->User->useValidationRules('ChangePassword');
		$this->User->validate['password_confirm']['compare']['rule'] =
		  array('password_match', 'password', false);
		  
		$this->User->current_user_id = $this->Auth->user('id');
		
		//debug($this->Auth->password($this->data['User']['password']));
		  
		if ($this->request->is('post')) {
			$this->User->set($this->request->data);
			debug($this->request->data);
			if (!empty($this->request->data) && $this->User->validates()) {
				$this->_f('Your password has been updated');
				$this->User->id = $this->Auth->user('id');
				$this->User->saveField('password',
					$this->data['User']['password']);
				$this->redirect(array('action' => 'account'));
			}
			else
			{
				$this->_f('Your password could not be updated', 'flash_error');
			}
		}
		
		$current_user = $this->User->findById($this->Auth->user('id'));
		$this->set('current_user', $current_user);
	}
	
	/**
	* Verify the user email by checking token
	**/
	
	function verify_email($token = null)
	{
	
		if ($this->Auth->user()) {
			$this->redirect(array('controller' => 'users', 'action' => 'index'));
		}

		$Token = ClassRegistry::init('Token');
		
		if($data = $Token->get($token)) 
		{
			$this->User->id = $data['User']['id'];
			$this->User->saveField('verified', true);
			
			$this->_f('Your eamil has been verified');
			$this->redirect(array('controller'=>'users', 'action' => 'index'));
		}
		
	}
	
	function need_verify_email()
	{
		if ($this->Auth->user()) {
			$this->redirect(array('controller' => 'users', 'action' => 'index'));
		}

		if ($this->request->is('post')) {
			if (!empty($this->request->data['User']['email']))
			{
				$Token = ClassRegistry::init('Token');
				$user = $this->User->findByEmail($this->request->data['User']['email']);

				if ($user == NULL) 
				{
					$this->_f('No matching user found', 'flash_error');
					return false;
				}

				$token = $Token->generate(array('User' => $user['User']));
				$this->_f('A verification email has been sent to your account, please follow the instructions in this email.');
				
				$Email = new CakeEmail();
				// Send email with new password
				$Email->to($user['User']['email'])
					->config('smtp')
					->subject('Email Verification')
					->from('no-reply@discoverpost.com')
					->template('email_verify')
					->viewVars(array('user' => $user, 'token' => $token))
					->emailFormat('html');
					
				try
				{
					$Email->send();
					$this->Session->setFlash('A verification email has been sent to your account, please follow the instructions in this email.');
				}
				catch(Exception $e)
				{
					$this->_f('An error occurred while sending verification email.', 'flash_error');
				}
			}
		}
	}

	/**
	 * Allows the user to email themselves a password redemption token
	 */
	function recover()
	{
		if ($this->Auth->user()) {
			$this->redirect(array('controller' => 'users', 'action' => 'index'));
		}
		
		if ($this->request->is('post')) {
			if (!empty($this->request->data['User']['email'])) {
				$Token = ClassRegistry::init('Token');
				$user = $this->User->findByEmail($this->data['User']['email']);

				if ($user == NULL) {
					$this->_f('No matching user found', 'flash_error');
					return false;
				}

				$token = $Token->generate(array('User' => $user['User']));
				
				$Email = new CakeEmail();
				// Send email with new password
				$Email->to($user['User']['email'])
					->config('smtp')
					->subject('Password Recovery')
					->from('support@discoverpost.com')
					->template('recover')
					->viewVars(array('user' => $user, 'token' => $token))
					->emailFormat('html');
					
				try
				{
					$Email->send();
					$this->Session->setFlash('A verification email has been sent to your account, please follow the instructions in this email.');
				}
				catch(Exception $e)
				{
					$this->_f('An error occurred while sending verification email.', 'flash_error');
				}

			}
		}
	}

	/**
	 * Accepts a valid token and resets the users password
	 */
	function verify($token = null)
	{
		if ($this->Auth->user()) {
			$this->redirect(array('controller' => 'users', 'action' => 'index'));
		}

		$Token = ClassRegistry::init('Token');
		
		if ($data = $Token->get($token)) {
			// Update the users password
			$password = $this->User->generatePassword();
			$this->User->id = $data['User']['id'];
			$this->User->saveField('password', $password);
			$this->set('success', true);

			$Email = new CakeEmail();
			// Send email with new password
			$Email->to($data['User']['email'])
				->config('smtp')
				->subject('Password Changed')
				->from('support@discoverpost.com')
				->viewVars(array('user' => $data, 'password' => $password))
				->template('verify')
				->emailFormat('html');
				
			try
			{
				$Email->send();
				//$this->Session->setFlash('');
			}
			catch(Exception $e)
			{
				//$this->_f('.', 'flash_error');
			}
				
		}
	}

}

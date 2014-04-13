<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
App::uses('Controller', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $helpers = array('Js', 'Html', 'MyHtml');
	
	public $SHOW_ALL = false;
	
	public $components = array(
		'Session',
		'AppAuth' => array(
			'loginRedirect' => array('controller' => 'my_trips', 'action' => 'index'),
			//'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
			'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
			'authorize' => array('Controller'), // Added this line
			'authenticate' => array(
				'Form' => array(
					'fields' => array('username' => 'email'),
				)
			)
		)
	);
	
	protected function _f($message = null, $element = 'default')
	{
		if($message)
		{
			$this->Session->setFlash($message, $element);
		}
	}
	
	public function beforeFilter() {
	
		$this->Auth->autoRedirect = false;
		$this->set('Auth',$this->Auth);
	}
	
    public function beforeRender()
    {
		//check if user is verified
		if ($this->Auth->user() && $this->Auth->user('role') != 'admin' && $this->Auth->user('verified') == false) 
		{
			//redirect user to verify email if not verified
			$this->Auth->logout();
			$this->redirect(array('controller' => 'users', 'action' => 'need_verify_email'));
		}
		
		//change flash message default
		if ($this->Session->check('Message.flash')) {
			$flash = $this->Session->read('Message.flash');

			if ($flash['element'] == 'default') {
				$flash['element'] = 'flash_success';
				$this->Session->write('Message.flash', $flash);
			}
		}

    }
	
	public function getZone($zone = null)
	{
	
		$changeZone = array (
		  'Pacific/Honolulu' => 'Hawaii',
		  'America/Anchorage' => 'Alaska',
		  'America/Los_Angeles' => 'Pacific Time (US & Canada)',
		  'America/Phoenix' => 'Arizona',
		  'America/Denver' => 'Mountain Time (US & Canada)',
		  'America/Chicago' => 'Central Time (US & Canada)',
		  'America/New_York' => 'Eastern Time (US & Canada)',
		  'America/Indiana/Indianapolis' => 'Indiana (East)'
		);
	
		if($zone != NULL)
		{
			if (array_key_exists($zone, $changeZone))
			{
				return $changeZone[$zone];
			}
			
			return $zone;
		}
	}
	
	
	public function constructClasses() {
        parent::constructClasses();
        $this->Auth = $this->AppAuth;
    }
	
	public function isAuthorized($user) {
		if($this->Auth->user('role') == 'admin') {
			//$this->Auth->allow('*');
			return true;
		} 
		elseif($this->Auth->user('role') == 'user') { 
			//$this->Auth->allow('index');
			return false;
		}
	}
	
	public function sendJson($response, $status = 200, $element = null)
	{
		// Make sure no debug info is printed
		//Configure::write('debug', 0); // Turn this to 2 for debugging
		// Set the data for view
		$this->set('response', $response);
		// We will use no layout
		$this->layout = '';
		//set the status of the response
		$this->response->statusCode($status);
		// Render the json element 
		if($element != null)
			$this->render('/Elements' . DS . $element);
		else
			$this->render('/Elements' . DS . 'json');
	}
}

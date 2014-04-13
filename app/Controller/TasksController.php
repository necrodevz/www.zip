<?php 
class TasksController extends AppController {
	var $name = 'Tasks';
	var $helpers = array('Html', 'Form');
	function index()
	 {
		$this->set('tasks', $this->Task->find('all')); 
	  }
	  
	  
	  function add() { 
if (!empty($this->data)) 
{ $this->Task->create();
 if ($this->Task->save($this->data)) { 
	$this->Session->setFlash('The Task has been saved'); 	

$this->redirect(array('action'=>'index'), null, true); 
 } else {
	$this->Session->setFlash('Task not saved. Try again.'); 
             } 
}
}

function edit($id = null) 
{

	if (!$id) {
		$this->Session->setFlash('Invalid Task');
		$this->redirect(array('action'=>'index'), null, true);
	               }
	if (empty($this->data)) {
		$this->Task->find('first', array('condition' => array('id' => $id) ) );
	} else {
	$this->request->data['Task']['id'] = $id;
	if ($this->Task->save($this->data)) {
		$this->Session->setFlash('The Task has been saved');
		$this->redirect(array('action'=>'index'), null, true);
	} else {
		$this->Session->setFlash('The Task could not be saved.
					        Please, try again.');	 
	           } 
	} 
}
				          }
 ?>
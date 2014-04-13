<?php
class SchedulersController extends AppController
{
	var $components = array('Email');
	var $name = 'Schedulers';
	
	function beforeFilter()
	{
		parent::beforeFilter();
		$this->Auth->allow('calendar');
	}
	
	public function calendar()
	{
		$response = [array("title"=>"","start"=>"2013-04-23T12:00:00+04:00","end"=>"2013-04-23T22:00:00+04:00","allDay"=>false,"data"=>array("scheduler_id"=>1916,"trip_id"=>5295,"guide_id"=>17196,"multiday"=>false,"recurring"=>false,"start_time"=>"2013-04-23T12:00:00+04:00","quantity_min"=>1,"quantity_max"=>2))];
		$this->sendJson($response);
	}
	
	public function events()
	{
		$response = array("title"=>"","start"=>"2013-04-23T12:00:00+04:00","end"=>"2013-04-23T22:00:00+04:00","allDay"=>false, "time_zone"=>"Asia/Tbilisi");
		$this->sendJson($response);
	}
	
}
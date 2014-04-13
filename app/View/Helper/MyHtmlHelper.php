<?php

class MyHtmlHelper extends Helper {

	var $helpers = array("Html");
	
	private function parselink($link)
	{
		try
		{
			$link = preg_replace('/\//','',$link);
		}
		catch(Exception $e){}
		
		return $link;
	}

   	public function userlink($name, $link = null, $other = array(), $match = null)
	{
		//$view = new View($this);
		$Html = $this->Html;
		$class = '';
		
		if($name != null)
		{
			
			if($match == null)
			{
				if(!empty($link) && is_array($link))
					$match = $link['controller'].$link['action'];
				else
					$match = $link;
			}
			
			if($this->parselink($this->request->here) == $this->parselink($match))
			{
				if(is_array($other) && !empty($other) &&isset($other['class']))
				{
					$other['class'] = $other['class'].' active';
				}
			}
			return $Html->link($name, $link, $other);
		}
	}
}

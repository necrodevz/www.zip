<?php

App::uses('Component', 'Controller');

/**
 * Pagination Array Component class file.
 */
class PaginatorArrayComponent extends Component{

    var $limit = 10;
    var $step = 1;
	var $order = array();

/**
 * Constructor
 *
 * @param ComponentCollection $collection A ComponentCollection this component can use to lazy load its components
 * @param array $settings Array of configuration settings.
 */	
	public function __construct(ComponentCollection $collection, $settings = array()) {
		$settings = array_merge($this->settings, (array)$settings);
		$this->Controller = $collection->getController();
		parent::__construct($collection, $settings);
	}

    function getParamsPaging($model, $page, $total, $current){
        $pageCount = intval(ceil($total / $this->limit));
        $prevPage = false;
        $nextPage = false;

        if($page > 1)
            $prevPage = $page - 1;

        if($page + 1 <= $pageCount)
            $nextPage = $page + 1;
			
		$paging = array(
					'page' => $page,
					'current' => $current,
					'count' => $total,
					'prevPage' => $prevPage,
					'nextPage' => $nextPage,
					'pageCount' => $pageCount,
					'step' => $this->step,
					'order' => array(
					),
					'limit' =>  $this->limit,
					'options' => array(
						'conditions' => array(),

					),
					'paramType' => 'get'//'named'
				);
			
		if (!isset($this->Controller->request['paging'])) {
			$this->Controller->request['paging'] = array();
		}
		
		$this->Controller->request['paging'] = array_merge(
			(array)$this->Controller->request['paging'],
			array($model => $paging)
		);
		
		return true;
    }
	
	public function paginate($Model, $array, $page = 1) {
	  // array_slice() to extract needed portion of data (page)
	  // usort() to sort data using comparision function $this->sort()	  
	  usort(
			$array,
			array($this, 'sort') // callback to $this->sort()
		  );
		  
	  $total = count($array);
	  
	  $slicedArray = array_slice(
					  $array,
					  $page-1*$this->limit,
					  $this->limit
					);
					
	  $this->getParamsPaging($Model, $page, $total,count($slicedArray));
	  
	  return $slicedArray;
	}
	
	public function sort($a, $b){
	  $result = 0;
	  foreach($this->order as $key => $order) {
		list($table, $field) = explode('.', $key);
		 if($a[$table][$field] == $b[$table][$field])
		  continue;
		 $result = ($a[$table][$field] < $b[$table][$field] ? -1 : 1) *
		  ($order == 'asc' ? 1 : -1);
	  }
	  return($result);
	}

}
?>
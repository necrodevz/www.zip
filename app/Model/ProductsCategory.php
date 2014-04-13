<?php

class ProductsCategory extends AppModel
{
	/**
	 * Standard validation behaviour
	 */
	 
	 public $belongsTo = array('Product', 'Category');
	
}
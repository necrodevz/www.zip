<?php

class ProductsSubCategory extends AppModel
{
	/**
	 * Standard validation behaviour
	 */
	
	public $belongsTo = array('SubCategory', 'Product');
	
}
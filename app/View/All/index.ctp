<!--style for image in popup on map-->

<style>


</style>

<link href='http://fonts.googleapis.com/css?family=Oswald:700' rel='stylesheet' type='text/css'>



<?php 
if($Auth->user('role') == 'admin'):
?>
<!--<div class="Add_Product">
	<p>
		<?php echo $this->Html->link('Add Product', array('controller'=>'products', 'action'=>'add'), array('class'=>'btn btn-info')); ?>
	</p>
</div>-->
<?php endif; ?>


<!--<div style="margin-bottom:10px;padding:10px;">
	<?php
		echo $this->Paginator->counter(
			'Page {:page} of {:pages}, showing {:current} records out of
			 {:count} total, starting on record {:start}, ending on {:end}'
		);
	?>
</div>-->
		<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
		<div id="map-canvas"></div>
		
		</nav>	
		

  <div class="products_container">
     <div class="products_main" style="margin-top:72px;" id="postswrapper">
	     <div class="framed2-header framed2-header-small" style="margin-bottom:20px;">
	        <div class="product_title">
			   <h3>Artistes Available</h3>
			   <h5>These are the list of available Artistes</h5>
		    </div>
		 </div>
    <?php 

      foreach($products as $product)
    {
    ?>
      <div class="span4 trip-card offset1">
         <a href="/product/<?php echo $product['Product']['url']; ?>">
            <div style="background:url('/files/products/<?php 
		 
		    for($i=0; $i < sizeof($product['Image']); $i++)
		    {
			   if($product['Image'][$i]['position'] == 0)
				echo $product['Image'][$i]['image'];
		    }
		 
		    ?>') no-repeat;background-size:cover; background-size:550px;" class="card">
            </div>
         </a>
               <div class="banner">
                  <div class="title"><?php echo $product['Product']['name']; ?></div>			   
			      <div class="amount-all">
			        <div class="amount-title-div">
                    </div>
				 
			      </div>
                </div>		 
      </div>
   
   <?php
   }
?>


	</div>
	</div>

 <div id="page_navigation" class="clearfix page_pagination">
	<?php
	
	  echo $this->paginator->prev(
		'<< Prev',
		array(
		  'class' => 'previous_link'
		),
		null,
		array(
		  'class' => 'previous_link current'//DisabledPgLk'
		)
	  ).
	  $this->paginator->numbers(
		array(
			'class' => 'page_link',
			'separator' => '',
		)
	  ).
	  $this->paginator->next(
		'Next >>',
		array(
		  'class' => 'next_link'
		),
		null,
		array(
		  'class' => 'next_link current' //DisabledPgLk'
		)
	  );

	?>
</div>

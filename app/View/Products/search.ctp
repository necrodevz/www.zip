

<?php 
	$this->Paginator->options(array(
		'convertKeys' => array('q'),
		'url' => array(
			'q'=>$q,
		)
	));

?>

<!--style for image in popup on map-->

<style>

<?php 

 foreach($products as $product)
 {
 ?>
 
 
.map-image<?php echo $product['Product']['id']; ?>  {
         background:url('/files/products/<?php 
		 
		 for($i=0; $i < sizeof($product['Product']['Image']); $i++)
		 {
			if($product['Product']['Image'][$i]['position'] == 0)
				echo $product['Product']['Image'][$i]['image'];
		 }
		 
		 ?>')no-repeat;background-size:cover;
		  background-size:430px;
		  height:130px;
		  width: 92%;
          margin-left: 16px;
}

        <?php
        }
       ?>
</style>


<script>
function initialize() {
  <?php 

 foreach($products as $product)
 {
 ?>
  var P<?php echo $product['Product']['id']; ?> = new google.maps.LatLng(<?php echo $product['Product']['latitude']; ?>,<?php echo $product['Product']['longitude']; ?>);
     <?php
   }
?>
  var mapOptions = {
    zoom: 8,
    center: P<?php echo $product['Product']['id']; ?>,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };

  var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
  
       <?php 

        foreach($products as $product)
       {
       ?>
  
  var des<?php echo $product['Product']['id']; ?> = '<div id="content">'+
      '<div id="siteNotice">'+
      '</div>'+
	  '<a href="/product/<?php echo $product['Product']['url']; ?>">"'+
	  '<div class="map-image<?php echo $product['Product']['id']; ?>">'+
	  '</div>'+
      '<h1 id="firstHeading" class="firstHeading"><?php echo $product['Product']['name']; ?></h1>'+
      '<div id="bodyContent">'+
      '</div>'+
	  '</a>'+
      '</div>';
	  
      <?php
        }
       ?>
	   
	   
	   <?php 

        foreach($products as $product)
       {
       ?> 

  var info<?php echo $product['Product']['id']; ?> = new google.maps.InfoWindow({
      content: des<?php echo $product['Product']['id']; ?>
  });
  
        <?php
        }
       ?>
      
  
  
  <?php 

 foreach($products as $product)
 {
 ?>
  var marker<?php echo $product['Product']['id']; ?> = new google.maps.Marker({
      position: P<?php echo $product['Product']['id']; ?>,
      map: map,
      title: '<?php echo $product['Product']['name']; ?>',
	  icon: '../img/dance_class.png'
  });
  

  
  
  google.maps.event.addListener(marker<?php echo $product['Product']['id']; ?>, 'click', function() {
    info<?php echo $product['Product']['id']; ?>.open(map,marker<?php echo $product['Product']['id']; ?>);
  });
  
         <?php
   }
?>
}

google.maps.event.addDomListener(window, 'load', initialize);
</script>


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
<div class="filter">  
    <div class="filter-child">
     <ul style="display:inline-block">
     <li class='dropdown'>
        <a class='dropdown-toggle cat-drop' data-toggle='dropdown' href='#'>
           Categories
           <b class='caret caret-cat'></b>
        </a>
        <ul class='dropdown-menu drop-custom cus'>
        <li class="dropdown-li-pro"><a href="/products/search?cat=1">Parties</a></li>
         <li class="dropdown-li-pro"><a href="/products/search?cat=2">Festivals</a></li>
         <li class="dropdown-li-pro"><a href="/products/search?cat=3">Theatres/Cinemas</a></li>
         </ul>
      </li>
	  </ul>
	  <div style="display:inline-block"><button  class="btn-info" id="showRight">Open/Close Map</button></div>
	  </div>
</div>
<div class="main_1">
 <div class="products-main-parent">
  <div class="products_main" style="padding-top:130px;" id="postswrapper">
	     <div class="framed2-header framed2-header-small" style="margin-bottom:20px;">
	        <div class="product_title">
			   <h3>Events Available</h3>
			   <h5>These are the list of available events that you can use TickitMe to buy tickets for.</h5>
		    </div>
		 </div>		 

<?php 

 foreach($products as $product)
 {
 ?>
   <div class="span4 trip-card offset1">
      <a href="/product/<?php echo $product['Product']['url']; ?>">
         <div style="background:url('/files/products/<?php 
		 
		 for($i=0; $i < sizeof($product['Product']['Image']); $i++)
		 {
			if($product['Product']['Image'][$i]['position'] == 0)
				echo $product['Product']['Image'][$i]['image'];
		 }
		 
		 ?>') no-repeat;background-size:cover; background-size:430px;" class="card">
               <div class="banner">
                  <div class="title"><?php echo $product['Product']['name']; ?></div>
                  <div class="tagline"><?php echo $product['Product']['address']; ?></div>
			   
			      <div class="amount-all">
			        <div class="amount-title-div">
			         <span><?php if(!empty($product['Product']['price_low']))echo '<span class="amount-title">Regular</span>'; else echo ''; ?></span>
			        </div>
                    <div class="amount">
                     <span class="price_main"><?php if(!empty($product['Product']['price_low']))echo '$'. $product['Product']['price_low']; else echo ''; ?></span>
                    </div>
				 
			      </div>
                </div>
         </div>
      </a>
   </div>
   
   <?php
   }
?>



</div>

		<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right" id="cbp-spmenu-s2">
		<div id="map-canvas"></div>
		
		</nav>
  </div>		
</div>

<script src="../js/classie.js"></script>
		<script>
			var menuRight = document.getElementById( 'cbp-spmenu-s2' ),
				showRight = document.getElementById( 'showRight' ),
				body = document.body;
				
			showRight.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( menuRight, 'cbp-spmenu-open' );
				disableOther( 'showRight' );
			};

			function disableOther( button ) {
				if( button !== 'showLeft' ) {
					classie.toggle( showLeft, 'disabled' );
				}
			}
		</script>

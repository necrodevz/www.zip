<head>
    <meta charset="utf-8">
        <style>
            /* Demo styles */
            html,body{background:#222;margin:0;}
            body{border-top:4px solid #000;}
            .content{color:#777;font:12px/1.4 "helvetica neue",arial,sans-serif;width:620px;}
            h1{font-size:12px;font-weight:normal;color:#ddd;margin:0;}
            p{margin:0 0 20px}
            a {color:#22BCB9;text-decoration:none;}
            .cred{margin-top:20px;font-size:11px;}

            /* This rule is read by Galleria to define the gallery height: */
            #galleria{height:435px}

			

						  
						  body  {
						  background:url('/files/products/<?php 		 
					for($i=0; $i < sizeof($product['Image']); $i++)
					{
						if($product['Image'][$i]['position'] == 0)
							echo $product['Image'][$i]['image'];
					}?>') no-repeat; background-size:cover;
					width:100%;
						  }
   html  {
   width:100%;
   }
						  
			.container-content {
    padding-top: 44px !important;
    width: 100% !important;
	}
	
	
	#ProductRegular, #ProductChild, #ProductVIP  {
	width:150px !important;
	color:#ddd !important;
}

 #map_canvas {
 height: 260px;
 width:328px;
}
				             
        </style>

        <!-- load jQuery -->

        <!-- load Galleria -->
    <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
    <script>
      function initialize() {
	  var myLatlng = new google.maps.LatLng(<?php echo $product['Product']['latitude']; ?>,<?php echo $product['Product']['longitude']; ?>);
        var map_canvas = document.getElementById('map_canvas');
        var map_options = {
          center: new google.maps.LatLng(<?php echo $product['Product']['latitude']; ?>,<?php echo $product['Product']['longitude']; ?>),
          zoom: 14,
          mapTypeId: google.maps.MapTypeId.ROADMAP
        }
        var map = new google.maps.Map(map_canvas, map_options);
		
		 var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Hello World!',
	  icon: '../img/dance_class.png'
  });
      }
      google.maps.event.addDomListener(window, 'load', initialize);
	  
	  
    </script>
    </head>
	
	
	
	<div class='products_main' style="margin-top: 72px !important;">
	   <div class='span8'>
		  <div class='trip-header' id='trip-header'>
			 <div class='trip-cover trip-cover-open' data-carouselindex='4'>
				
	<div class="content">
   

        <div id="galleria">
                <img src="/files/products/<?php 		 
					for($i=0; $i < sizeof($product['Image']); $i++)
					{
						if($product['Image'][$i]['position'] == 0)
							echo $product['Image'][$i]['image'];
					}
				?>"style="top: -18px; width: 100%;" />
				
				<?php 
					$i = 0;
					foreach($images as $id => $image)
					{
						if($i != 0)
						{
				?>
				
				<img src="/files/products/<?php echo $image; ?>"/>
				<?php
						}
						$i += 1;
					 }
				?>
				
           
        </div>
    </div>
				
			 </div>
			 <div class='trip-title trip-title-rounded'>
				<h1>
				  <?php echo $product['Product']['name']; ?>
				</h1>
				<div class='trip-header-props'>
				   <div class='trip-header-prop'>
					  <i class='icon-map-marker icon-white'></i>
					  <?php echo $product['Product']['address']; ?>
				   </div>
				   <div class='trip-header-prop'>
					  <i class='icon-time icon-white'></i>
					  <?php echo $product['Product']['start_date']; ?>
				   </div>
					   <div class='trip-header-prop'>
						  <a href="<?php echo $product['Product']['facebook']; ?>" target="_blank"><div class="social-media face"><i class="fa fa-facebook"></i></div></a>
					   </div>
					   <div class='trip-header-prop'>
					      <div class='trip-header-prop'>
						    <a href="<?php echo $product['Product']['twitter']; ?>" target="_blank"><div class="social-media twitter"><i class="fa fa-twitter"></i></div></a>
					      </div>
					   </div>		
				</div>
			 </div>
		  </div>
		  <div class='framed2 framed2-flat trip-section'>
			 <div class='trip-editor-description' style='padding-top: 0px'>
			   <div class="framed2-header framed2-header-small">
				<h3>About <?php echo $product['Product']['name']; ?></h3>
			   </div>
				<p><?php echo  nl2br($product['Product']['description']); ?> </p>
			 </div>
		  </div>
		  
		  <div class='framed2 trip-section'>
			 <div class='trip-editor-description' style='padding-top: 0px'>
			   <div class="framed2-header framed2-header-small">
				<h3><?php echo $product['Product']['name']; ?> Video</h3>
			   </div>
				<?php echo $product['Product']['youtube'] ?>
			 </div>
		  </div>
		  
		  <div class='row' style='margin-bottom: 20px'></div>
		  </form>
	   </div>
	   <div class='span4'>
		  <div class="trip-framed framed2 framed2-flat">
			 <div style="padding: 20px 20px; border-bottom:1px solid #555;">			    
				
				<div class="ticket-price">
				    
				</div>

			 </div>
			 
			 	<div id="booking" class="booking" style="padding:20px">
				   <?php 
						$button = 'Add To Fan List'; 
						if(empty($product['MyTrip']) || !$Auth->user())
						{
							echo $this->Form->create('MyTrip', array('action'=>'add/'.$product['Product']['url']));
						}
						else
						{
							echo $this->Form->create('MyTrip', array('action'=>'remove/'.$product['Product']['url']));
							$button = 'Remove From My Fan List'; 
						}
						
					?>
					  <div style="" class="booking-loading-hide">
						 <div class="booking-button-now">
							<button style="width: 100%" class="btn btn-info btn-large">
							<?php echo $button; ?>
							</button>
						 </div>
					  </div>
				   </form>
				</div>
		  </div>
		  <div class="row guide-box">
	   
			   <div class="itinerary more">
				  
				  	<div class="framed3 framed2-flat">
						   <div class="framed2-header framed2-header-small">
							  Favourite Song
						   </div>
						   <div style="">
		  	                 <div class="maps">
			                 <p><?php echo $product['Product']['fav_song']; ?></p>
			                 </div>						   
						   </div>
						</div>
						
								  <div class="row guide-box">
	   
			   <div class="itinerary more">
				  
				  <div class="row">
					 
				  </div>
				  
				  <div class="framed3 framed2-flat">
						   <div class="framed2-header framed2-header-small">
							  Role Model
						   </div>
						   <div style="padding: 20px 20px 0 20px; color:#333; font-size:16px">
						   	 <p><?php echo $product['Product']['role_model']; ?> </p>
						   </div>
						</div>
			   </div>

		  <div style="margin-top: 20px" class="row">
	 
		  </div>
	   </div>
				  
				  <div class="framed3 framed2-flat">
						   <div class="framed2-header framed2-header-small">
							  Similar Artistes
						   </div>
						   <div style="padding: 20px 20px 0 20px; color:#333; font-size:16px">
						   <?php foreach($similar_products as $similar_product):?>
							  <div style="padding-bottom: 20px" class="row-fluid similar">
								 <div class="similar-image">
									<a href="/product/<?php echo $similar_product['Product']['url']; ?>">
										<img width="80px" height="80px" src="/files/products/<?php 
		 
											 for($i=0; $i < sizeof($similar_product['Image']); $i++)
											 {
												if($similar_product['Image'][$i]['position'] == 0)
													echo $similar_product['Image'][$i]['image'];
											 }
											 
											 ?>" class="trip-picture" alt="Image">
									</a>
								 </div>
								 <div class="similar-info">
									<div class="more-link" style="margin-top: -4px">
									   <a href="product/<?php echo $similar_product['Product']['url']; ?>" class="text-color">
									   <strong>
									   <?php echo $similar_product['Product']['name']; ?>
									   </strong>
									   </a>
									</div>
								 </div>
							  </div>
							 <?php endforeach; ?>
						   </div>
						</div>
			   </div>
		  <div style="margin-top: 20px" class="row">
	 
		  </div>
	   </div>
  </div>
	<div class='row' style='margin-top: 20px'>
	   <div class='span4'>
	   </div>
	</div>
 </div>
     <script>

    // Load the classic theme
    Galleria.loadTheme('/js/galleria.classic.min.js');

    // Initialize Galleria
    $('#galleria').galleria({
	transition: 'fade',
	transitionSpeed: 1600,
    imageCrop: true
});

    </script>
 
 
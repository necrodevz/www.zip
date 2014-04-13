
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
			   
			     <div class="amount-title-div">
			      <span><?php if(!empty($product['Product']['price_high']))echo '<span class="amount-title">VIP</span>'; else echo ''; ?></span>
			     </div>
                 <div class="amount">
                  <span class="price_main"><?php if(!empty($product['Product']['price_high']))echo '$'. $product['Product']['price_high']; else echo ''; ?></span>
                 </div>
				 
				 <div class="amount-title-div">
			      <span><?php if(!empty($product['Product']['children']))echo '<span class="amount-title">Children</span>'; else echo ''; ?></span>
			     </div>
                 <div class="amount">
                  <span class="price_main"><?php if(!empty($product['Product']['children']))echo '$'. $product['Product']['children']; else echo ''; ?></span>
                 </div>
				 
			   </div>
			   
			   <div class="date">
			     <span><i class='icon-time icon-white'></i></span><span><?php echo $product['Product']['start_date']; ?></span>
			   </div>
               <div class="clearfix"></div>
            </div>
         </div>
      </a>
   </div>
   
   <?php
   }
?>

<div class='row'>
 <div class='span10 offset1'>
	<div class='btn-toolbar nav-wizard-toolbar'>
	   <div class='btn-group nav-wizard'>
		  <a class='btn btn-large btn-nav <?php if(isset($nav) && $nav == 'product') echo 'active'; else echo 'form-submit'; ?>' href="/products/add/<?php if(isset($product)) echo $product['Product']['url'];?>">
		  My Product
		  <span class='nav-divider-after'  ></span>
		  </a>
		  <a class='btn btn-large btn-nav <?php if(isset($nav) && $nav == 'photo') echo 'active'; else echo 'form-submit'; ?>' data-tab='media' style='border-left: 0' href="/products/photo/<?php if(isset($product)) echo $product['Product']['url'] ;?>">
		  <span class="nav-divider-before nav-divider-before-prev-selected" ></span>
		  Photos
		  <span class="nav-divider-after"></span>
		  </a>
		  <!--<a class='btn btn-large btn-nav <?php if(isset($nav) && $nav == 'schedule') echo 'active'; else echo 'form-submit'; ?>' data-tab='schedule' href="/products/schedule/<?php if(isset($product)) echo $product['Product']['url'] ;?>">
			  <span class="nav-divider-before"></span>
			  Schedule
			  <span class="nav-divider-after"></span>
		  </a>
		  <a class='btn btn-large btn-nav form-submit' data-tab='profile'>
		  <span class="nav-divider-before"></span>
		  Profile
		  <span class="nav-divider-after"></span>
		  </a>
		  <a class='btn btn-large btn-nav <?php if(isset($nav) && $nav == 'payment') echo 'active'; else echo 'form-submit'; ?>' data-tab='payout'>
		  <span class="nav-divider-before"></span>
		  Payment
		  <span class="nav-divider-after"></span>
		  </a>-->
		  <a class='btn btn-large btn-nav <?php if(isset($nav) && $nav == 'publish') echo 'active'; else echo 'form-submit'; ?>' data-tab='publish' href="/products/publish/<?php if(isset($product)) echo $product['Product']['url'] ;?>">
		  <span class="nav-divider-before"></span>
		  Publish
		  </a>
	   </div>
	</div>
	<div class='alert alert-error' id='validation-errors' style='display: none'>
	   &nbsp;
	</div>
 </div>
</div>
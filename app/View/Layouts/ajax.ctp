<!DOCTYPE html>
<?php echo $this->Facebook->html(); ?>
<head>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet"> 
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<!--<link href='http://fonts.googleapis.com/css?family=Tauri' rel='stylesheet' type='text/css'>-->
	<link href='http://jomhuriye.99k.org/fonts/discoveryfonts.css' rel='stylesheet' type='text/css'>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
	?>
	<?php
		echo $this->Html->css('default');
		echo $this->Html->css('flat-ui');
		echo $this->Html->script('jquery-1.7.1');
		echo $this->Html->script('jquery-ui');
		echo $this->Html->css('calendar');
		echo $this->Html->css('galleria.classic');
		echo $this->Html->css('sdmenu');
		echo $this->Html->css('bootstrap.min');
		echo $this->Html->css('bootstrap');
		//echo $this->Html->css('jquery.ptTimeSelect');		
		//echo $this->Html->css('jquery.ptTimeSelect');
		//echo $this->Html->script('jquery.timepicker');
		echo $this->Html->script('bootstrap');
		echo $this->Html->script('galleria-1.2.9.min');
		//echo $this->Html->script('jquery.mCustomScrollbar');
				//echo $this->Html->script('lightbox-2.6.min');
		echo $this->Html->script('modernizr.custom');
		echo $this->Html->script('sdmenu');
		//echo $this->Html->script('application');
		echo $this->Html->script('calendar');
		echo $this->Html->script('forms');
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<link href="/maps/documentation/javascript/examples/default.css" rel="stylesheet">
<link href='http://fonts.googleapis.com/css?family=Titillium+Web:300' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
  <script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
  <script src="/resources/demos/external/jquery.mousewheel.js"></script>
  <script src="http://maps.googleapis.com/maps/api/js?sensor=false"></script>
  
  <style>
  .products_main {
color: #555;
margin: 0 auto;
width: 960px;
}

.offset1 {
margin-left: 10px !important;
}

      html, body {
        height: 100%;
        margin: 0px;
        padding: 0px
      }
	  
	  #map-canvas  {
	  margin-top:60px;
	  height:100%;
	  }
	  
	  #galleria{height:460px;
	  margin-top:57px
	  }
</style>
</head>
<body>

 <nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    <div class="navbar-brand"><a href="http://tickitme.com"><img src="/img/tickitmelogo.png" style="height:50px;"/></a></div>
  </div>

  
  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-right">
	   <li>	  
	     	<div class="search-top">
			<form id="ProductSearchForm" class="form-search logged-out" accept-charset="utf-8" method="get" action="/products/search">
				<div class="input-append">
				    <input style="border:1px solid #222 !important; color:#eee !important" type="text" name="q" class="search-query" placeholder="Search" autocomplete="off" value="<?php if(isset($q))echo $q; ?>"/>
					<button class="search-top-button">
					   <i class="icon-search"></i>
					</button>
				</div>
			</form>
	</div>
	  </li>
	  <li class='divider-vertical'></li>
      <?php if($Auth->user()):?>
                     <li><?php echo $this->MyHtml->userlink('e-Pocket', '/home', array('class'=>'user-link')); ?></li>
					<?php else: ?>
                     <li><?php echo $this->MyHtml->userlink('e-Pocket', '/users/login', array('class'=>'user-link')); ?></li>
					<?php endif; ?>
                     <!--<li class='divider-vertical'></li>-->
					 <li><?php echo $this->MyHtml->userlink('Browse Events', array('controller'=>'All', 'action'=>'index'), array('class'=>'user-link'), '/products'); ?></li>
				  <?php 
					if(!$Auth->user())
					{
					?>					 
                     <li><?php echo $this->MyHtml->userlink('Login', array('controller'=>'users', 'action'=>'login'), array('class'=>'user-link')); ?></li>
                     <li><?php echo $this->MyHtml->userlink('Register', array('controller'=>'users', 'action'=>'register'), array('class'=>'user-link')); ?></li>
				  <?php 
					} 
					else
					{
					if($Auth->user('role') == 'admin'):
					?>
					 <!--<li><?php echo $this->MyHtml->userlink('Categories', array('controller'=>'sub_categories', 'action'=>'index'), array('class'=>'user-link'), '/sub_categories'); ?></li>-->
				  <?php endif; ?>
				  <?php
					}
				  ?>
				  
                  <li class='dropdown'>
                      <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                        Help
                        <b class='caret'></b>
                      </a>
                      <ul class='dropdown-menu'>
                         <li><?php echo $this->Html->link('Profile', array('controller'=>'users', 'action'=>'index'), array('class'=>'user-link')); ?></li>
                         <li><?php echo $this->Html->link('Change Password', array('controller'=>'users', 'action'=>'account'), array('class'=>'user-link')); ?></li>
                         <li><?php echo $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout'), array('class'=>'user-link')); ?></li>
                      </ul>
                  </li>
				  <?php 
					if($Auth->user()){
					?>
                     <li class='dropdown'>
                        <a class='dropdown-toggle' data-toggle='dropdown' href='#'>
                        Hi <?php echo $Auth->user('first_name'); ?>
                        <b class='caret'></b>
                        </a>
                        <ul class='dropdown-menu drop-custom'>
                           <li><?php echo $this->Html->link('Profile', array('controller'=>'users', 'action'=>'index'), array('class'=>'user-link')); ?></li>
                           <li><?php echo $this->Html->link('Change Password', array('controller'=>'users', 'action'=>'account'), array('class'=>'user-link')); ?></li>
                           <li><?php echo $this->Html->link('Logout', array('controller'=>'users', 'action'=>'logout'), array('class'=>'user-link')); ?></li>
                        </ul>
                     </li>
					<?php 
					} 
					?>
				  <li><a href="/Pages/add_event" class="btn-success" style="padding: 4px 12px !important; margin-top:9px; color:#fff !important;text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);">Add Your Event</a>
				  </li>
				  <li class="vertical-divider"></li>
				  <li class="vertical-divider"></li>
				  <li class="vertical-divider"></li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>
       
	  		
    <div class=''>

	  
	  
	 <div id='flash-notices'>
			<?php echo $this->Session->flash(); ?>
		 </div>
		<div id='content'>
			<?php echo $this->fetch('content'); ?>
		</div>

	</div>
	
	
			<!--<div class="clearfix" id="footer" style=" margin-top:70px; text-align:center; display:inline-block; width:100%; background-color:#111; position:absolute;">
			  <!--&copy2013 TicketME
			 <?php 
			 
				// echo $this->Html->link(
					// $this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					// 'http://www.cakephp.org/',
					// array('target' => '_blank', 'escape' => false)
				// );
				echo $this->Html->link(
					'Terms',
					'/terms',
					array('escape' => false)
				);
				
			?>
			
			
		</div>
		<div class="footer-left">
		<h5>Affiliates</h5>
		</div>
		<div class="footer-center">
		</div>
		<div class="footer-right">
		</div>-->
		
	<?php 
		if($Auth->user())
		{	
			//echo $this->element('sidebar');
		}
	?>
	<?php //echo $this->element('sql_dump'); ?>
	
	
</body>
<?php echo $this->Facebook->init(); ?>



<!--<script>
    (function($){
        $(window).load(function(){
            $(".modal-body").mCustomScrollbar();
        });
    })(jQuery);
</script>-->

<script>
  	$(function(){
    var pickerOpts = {
        dateFormat: $.datepicker.RFC_2822
    };  
    $("#datepicker").datepicker(pickerOpts);
});

  </script>
  
  <script type="text/javascript">
        $(document).ready(function(){
            // find the input fields and apply the time select to them.
            $('#sample1 input').ptTimeSelect();
        });
    </script>
  
    <script>

    // Load the classic theme
    Galleria.loadTheme('/js/galleria.classic.min.js');

    // Initialize Galleria
    Galleria.run('#galleria', {
    transition: 'fade',
	autoplay: 2000,
	transitionSpeed:1000,
	showInfo:true,
	_toggleInfo: false,
    imageCrop: true
});

    </script>

<?php echo $this->Facebook->init(); ?>
</html>



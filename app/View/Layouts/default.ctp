<!DOCTYPE html>
<?php echo $this->Facebook->html(); ?>
<head>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet"> 
<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
	<!--<link href='http://fonts.googleapis.com/css?family=Tauri' rel='stylesheet' type='text/css'>-->
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<?php
		echo $this->Html->meta('icon');
	?>
		<?php
		echo $this->Html->css('default');
        echo $this->Html->css('default_responsive');
		echo $this->Html->css('flat-ui');
		echo $this->Html->script('jquery-ui');
		echo $this->Html->css('calendar');
		echo $this->Html->css('galleria.classic');
		echo $this->Html->css('sdmenu');
		echo $this->Html->script('jquery-1.7.1');
		echo $this->Html->css('bootstrap.min');
		//echo $this->Html->css('jquery.ptTimeSelect');		
		//echo $this->Html->css('jquery.ptTimeSelect');
		//echo $this->Html->script('jquery.timepicker');
		echo $this->Html->script('bootstrap');
		echo $this->Html->script('modernizr.custom.17475');
		echo $this->Html->script('galleria');
		//echo $this->Html->script('jquery.mCustomScrollbar');
				//echo $this->Html->script('lightbox-2.6.min');
		echo $this->Html->script('modernizr.custom');
		echo $this->Html->script('sdmenu');
		//echo $this->Html->script('application');
		echo $this->Html->script('datetime');
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
				<div class="input-append ui-widget">
				    <input style="border:1px solid #222 !important; color:#eee !important" type="text" name="q" id="tags" class="search-query" placeholder="Search" autocomplete="off" value="<?php if(isset($q))echo $q; ?>"/>
					<button class="search-top-button">
					   <i class="fa fa-search"></i>
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
				  </li>
				  <li class="vertical-divider"></li>
				  <li class="vertical-divider"></li>
				  <li class="vertical-divider"></li>
    </ul>
  </div><!-- /.navbar-collapse -->
</nav>
       
	  		
    <div class='container container-content'>

	  
	  
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
		
		<div class="footer">
			<div class="footer-inner">
				<div class="container">
					
					<div class="clearfix"></div>
					<div class="row">
						<div class="col-md-2 col-sm-3">
							<div class="footer-widget">
								<h4><i class="fa fa-unlink"></i> &nbsp; Navigation</h4>
								<ul>
									<li><a href="#"><i class="fa fa-home"></i> &nbsp; Home</a></li>
									<li><a href="#"><i class="fa fa-gear"></i> &nbsp; Service</a></li>
									<li><a href="#"><i class="fa fa-laptop"></i> &nbsp; Feature</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-3 col-sm-4">
							<div class="footer-widget">
								<h4><i class="fa fa-user"></i> &nbsp; About Us</h4>
								<p>TickitMe is a multi-tier ticketing system that increase security for event holders while extending their product's reach through the use of new technology. </p>
								<div class="social">
									<a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
									<a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
									<a href="#" class="google-plus"><i class="fa fa-google-plus"></i></a>
									<a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
								</div>
							</div>
						</div>
						<div class="col-md-3 col-sm-5">
							<div class="footer-widget">
								<h4><i class="fa fa-phone"></i> &nbsp; Contact Us</h4>
								<span>Cloud Media Services</span>
								<p>27 Sullivan Avenue <br />Kingston 8 <br /> Jamaica W.I.<p>
								<p><span class="mute">E-mail</span> : <a href="#">frontdesk@cmsjm.com</a><br /> <span class="mute">Phone no.</span>8764324682</p>
							</div>
						</div>
						
					</div>
					<div class="copy">
						<p>&copy; Copyright <a href="#">Cloud Media Services</a></p>
					</div>
				</div>
			</div>
		</div>
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
  


<?php echo $this->Facebook->init(); ?>
</html>



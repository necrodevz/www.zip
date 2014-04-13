
	<head>
		<!-- Title here -->
		<title>:: RENATA ::</title>
		<!-- Description, Keywords and Author -->
		<meta name="description" content="Your description">
		<meta name="keywords" content="Your,Keywords">
		<meta name="author" content="ResponsiveWebInc">
		
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php $this->Html->meta('icon', $this->Html->url('/img/favicon.png')); ?>

		<link href='http://fonts.googleapis.com/css?family=Raleway:300' rel='stylesheet' type='text/css'>
		
		<!-- Styles -->
		<!-- Bootstrap CSS -->
	</head>
	
	<body>
		
		<!-- Header Bar Start -->

		
		<!-- Head Start -->
 <nav class="navbar navbar-default" role="navigation">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    <div class="navbar-brand"></div>
  </div>

  <!-- Collect the nav links, forms, and other content for toggling -->
  <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
    <ul class="nav navbar-nav navbar-left">
	   <li>	  
	<div class="search-top">
			<form id="ProductSearchForm" class="form-search logged-out" accept-charset="utf-8" method="get" action="/products/search">
				<div class="input-append">
				    <input style=" color:#eee !important" type="text" name="q" class="search-query" placeholder="Search" autocomplete="off" value="<?php if(isset($q))echo $q; ?>"/>
					<button class="search-top-button">
					<i class="fa fa-search"></i>
					</button>
				</div>
			</form>
	</div>
	  </li>
      <?php if($Auth->user()):?>
                     <li><?php echo $this->MyHtml->userlink('My Favourites', '/home', array('class'=>'user-link')); ?></li>
					<?php else: ?>
                     <li><?php echo $this->MyHtml->userlink('My Favourites', '/users/login', array('class'=>'user-link')); ?></li>
					<?php endif; ?>
					 <li><?php echo $this->MyHtml->userlink('Browse Artistes', array('controller'=>'All', 'action'=>'index'), array('class'=>'user-link'), '/products'); ?></li>
					 <!--<li><?php echo $this->MyHtml->userlink('Categories', array('controller'=>'sub_categories', 'action'=>'index'), array('class'=>'user-link'), '/sub_categories'); ?></li>-->

    </ul>
  </div><!-- /.navbar-collapse -->
</nav>
		<!-- Menu Bar End -->
		
		<!-- Revolution Slider Start -->
		<!-- Full width Banner container -->
		<div class="banner-container">
			<div class="banner">
			    <div class="login-front">
				   <div class="login-header">
				       Login
				   </div>
			<?php echo $this->Session->flash('auth'); ?>
			<?php echo $this->Form->create('User', array(
				'class' => '',
				'id'=>'update_user',
				'inputDefaults' => array(
					'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
					'label' => false,
					'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')),
				)));?>

			<?php echo $this->Form->input('email', array(
				'label' => false, 'placeholder'=>'Email Address', 'class'=>'form-control', 'div'=>'form-group'
			)); ?>
			
			<?php echo $this->Form->input('password', array('size'=>30,
				'label' => false,'placeholder'=>'Password', 'class'=>'form-control', 'div'=>'form-group'
			)); ?>
			
			<?php echo $this->Form->submit('Login', array('type'=>'submit',
						'class' => 'btn btn-success',
						'div' =>'form-group',
						'label' => false
				)); ?>	
			</form>
			
			 
			<div class="signup-front">Don't have an account? <span><?php echo $this->Html->link('Sign Up', array('controller'=>'users', 'action'=>'signup'), array('class'=>'btn btn-info')); ?></span></div>
				</div>
				
				<div class="banner-text-div">
				     <h1 class="banner-text">Music Connections and Exposure</h1>
				</div>

			</div>
		</div>
		<div class="clearfix"></div>
		
		
		<div class="feature">
			<div class="container">
				<div class="row">
				    <div class="top-about">
					  <h1>What We Are About</h1>
					</div>
					<div class="col-md-4 col-sm-7">
						<!-- Items for Feature list -->
						<div class="feature-item animated">
							<!-- Feature List Image -->
							<h1><i class="fa fa-music"></i></h1>
							<!-- Feature item heading and paragraph -->
							<h3>View Favourite Artistes</h3>
							<p>View the promo music of your favourite artistes</p>
		    
						</div>
					</div>
					<div class="col-md-4 col-sm-7">
						<!-- Items for Feature list -->
						<div class="feature-item animated">
							<!-- Feature List Image -->
							<h1><i class="fa fa-random"></i></h1>
							<!-- Feature item heading and paragraph -->
							<h3>Music Connections</h3>
							<p>Connects fans with artistes and promoters and managers</p>
		    
						</div>
					</div>
					<div class="col-md-4 col-sm-7">
						<!-- Items for Feature list -->
						<div class="feature-item animated">
							<!-- Feature List Image -->
							<h1> <i class="icon-globe"></i></h1>
							<h3>Promote To The World</h3>
							 <p>Promote yourself and your music to the world</p>
						</div>
					</div>
				</div>
				<hr />
			</div>
		</div>
		
		<!-- Feature End -->		
		
		<!-- Recent News Start -->
		
		
		<!-- Recent News End -->
		
		<!-- CTA Start -->
		
		
		<!-- CTA End -->
		
		<!-- Home Tabs Start -->
			

		
		<!-- Home Tabs End -->
		
		<!-- Pricing table Start -->
		
		
		<!-- Pricing table End -->
		
		<!-- Service Start -->
		
		
		<!-- Service End -->
		
		<!-- Testimonial Start -->
		

		
		<!-- Testimonial End -->
		
		<!-- Sponsor Start -->

		
		<!-- Sponsor End -->
		
		
		<!-- Scroll to top -->
		<span class="totop"><a href="#"><i class="fa fa-chevron-up"></i></a></span> 
		<!-- Footer Start -->
		
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
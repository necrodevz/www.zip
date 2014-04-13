<!DOCTYPE html>
<?php echo $this->Facebook->html(); ?>
<head>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet"> 
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
	?>
	<?php
		echo $this->Html->css('bootstrap');
		echo $this->Html->css('default1');
		echo $this->Html->script('jquery-ui');			
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
<link href='http://fonts.googleapis.com/css?family=Titillium+Web:300' rel='stylesheet' type='text/css'>
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	

</head>
<body>
       
	  		
    <div>
	 
	 <div id='flash-notices'>
			<?php echo $this->Session->flash(); ?>
		 </div>
		<div id='content'>
			<?php echo $this->fetch('content'); ?>
		</div>
		<div>
			  &copy2013 TicketME
			 <?php 
		
				echo $this->Html->link(
					'Terms',
					'/terms',
					array('escape' => false)
				);
				
			?>
		</div>
	</div>
	
	<?php 
		if($Auth->user())
		{	
		}
	?>
</body>
</html>



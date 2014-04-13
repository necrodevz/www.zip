<!DOCTYPE html>
<?php echo $this->Facebook->html(); ?>
<head>
<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet"> 
   
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo ('Music Connections') ?>
	</title>	
	<?php
		echo $this->Html->meta('icon');
	?>
<?php
        
		echo $this->Html->css('animate.min');	
        echo $this->Html->css('font-awesome.min');	
        echo $this->Html->css('jquery.countdown');		
		echo $this->Html->css('prettyPhoto');								
		echo $this->Html->css('rs-settings');
		echo $this->Html->css('style');
	?>
	
	
	<?php
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
		
	?>
	<link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.2/css/bootstrap.min.css" rel="stylesheet">
</head>
	  <body onload="">			
     
				
			<?php echo $this->fetch('content'); ?>
	
</body>
<?php echo $this->Facebook->init(); ?>
</html>


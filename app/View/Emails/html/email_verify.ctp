Hello <?php echo $user['User']['first_name']." ".$user['User']['last_name']." "; ?>
Welcome to Discoverpost to verify email address follow the link <?php echo $this->Html->link('Click Here', array('controller'=>'users', 'action'=>'verify_email', $token, 'full_base' => true), array('class'=>''));?>
<div class="users form">

<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend><?php echo __('Register User'); ?></legend>
        <?php echo $this->Form->input('email');
        echo $this->Form->input('password');
        /* echo $this->Form->input('role', array(
            'options' => array('admin' => 'Admin', 'user' => 'User')
        )); */
    ?>
    </fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
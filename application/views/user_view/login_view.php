<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h1>Tutorial: Simple Login Form</h1>

<?php if($this->session->flashdata('message')) : ?>
	<p><?=$this->session->flashdata('message')?></p>
<?php endif; ?>

<?php echo form_open('user/loginVals/')?>
	<?php echo form_fieldset('Login Form')?>
	
		<div class="textfield">
			<?php echo form_label('Email', 'user_email');?>
			<?php echo form_error('user_email'); ?>
			<?php echo form_input('user_email', set_value('user_email')); ?>
		</div>
		
		<div class="textfield">
			<?php echo form_label('password', 'user_pass')?>
			<?php echo form_error('user_pass')?>
			<?php echo form_password('user_pass')?>
		</div>
		
		<div class="buttons">
			<?php echo form_submit('login', 'Login'); ?>
		</div>
		
	<?php echo form_fieldset_close()?>
<?php echo form_close();?>
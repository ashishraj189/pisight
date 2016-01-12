<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h1>Sign Up</h1>

<?php if($this->session->flashdata('message')) : ?>
	<p><?=$this->session->flashdata('message')?></p>
<?php endif; ?>

<?php echo form_open('user/signupVals')?>
	<?php echo form_fieldset('Sign Up Form')?>
	
		<div class="textfield">
			<?php echo form_label('User Name', 'user_name');?>
			<?php echo form_error('user_name'); ?>
			<?php echo form_input('user_name'); ?>
		</div>
		
		<div class="textfield">
			<?php echo form_label('First Name', 'user_firstname')?>
			<?php echo form_error('user_firstname')?>
			<?php echo form_input('user_firstname',"")?>
		</div>
		
		<div class="textfield">
			<?php echo form_label('Last Name', 'user_lastname')?>
			<?php echo form_error('user_lastname')?>
			<?php echo form_input('user_lastname',"")?>
		</div>
		
		<div class="textfield">
			<?php echo form_label('Email', 'user_email')?>
			<?php echo form_error('user_email')?>
			<?php echo form_input('user_email',"")?>
		</div>
		
		<div class="textfield">
			<?php echo form_label('Password', 'user_password')?>
			<?php echo form_error('user_password')?>
			<?php echo form_password('user_password',"")?>
		</div>
		
		<div class="textfield">
			<?php echo form_label('Confirm Password', 'user_cnpassword')?>
			<?php echo form_error('user_cnpassword')?>
			<?php echo form_password('user_cnpassword',"")?>
		</div>
		
		
		<div class="textfield">
			<?php echo form_checkbox('aceepterms', '1', set_checkbox('1')); ?>Please Accept Terms & conditions
		</div>
		
		 
		<div class="buttons">
			<?php echo form_submit('login', 'Login'); ?>
		</div>
		
	<?php echo form_fieldset_close()?>
<?php echo form_close();?>
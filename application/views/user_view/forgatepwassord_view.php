<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h1>Forgate Password</h1>

<?php if($this->session->flashdata('message')) : ?>
	<p><?=$this->session->flashdata('message')?></p>
<?php endif; ?>

<?php echo form_open('user/forgatepassword_vals')?>
	<?php echo form_fieldset('Forgate Password')?>
	
		<div class="textfield">
			<?php echo form_label('Email', 'user_email')?>
			<?php echo form_error('user_email')?>
			<?php echo form_input('user_email')?>
		</div>
		<div class="buttons">
			<?php echo form_submit('forgate', 'Submit'); ?>
		</div>
		
	<?php echo form_fieldset_close()?>
<?php echo form_close();?>
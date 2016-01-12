<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h1>Onetime Code</h1>

<?php if($this->session->flashdata('message')) : ?>
	<p><?=$this->session->flashdata('message')?></p>
<?php endif; ?>

<?php echo form_open('user/chksecurity/')?>
	<?php echo form_fieldset('Security Questions')?>
	
		<div class="textfield">
			<?php echo form_label('One Time Valid Code', 'user_validcode');?>
			<?php echo form_error('user_validcode'); ?>
			<?php echo form_input('user_validcode', set_value('user_validcode')); ?>
		</div>
		
		<div class="buttons">
			<?php echo form_submit('submit_code', 'submit'); ?>
		</div>
		
	<?php echo form_fieldset_close()?>
<?php echo form_close();?>
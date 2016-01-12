<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h1>Security Questions</h1>

<?php if($this->session->flashdata('message')) : ?>
	<p><?=$this->session->flashdata('message')?></p>
<?php endif; ?>

<?php echo form_open('user/getSecrityQuestion/')?>
	<?php echo form_fieldset('Security Questions')?>
	
		<div class="textfield">
			<?php echo form_dropdown('user_secrity', $secqus, set_value('user_secrity', $secqus));  ?>
		</div>
		<div class="textfield">
			<?php echo form_label('Answer', 'user_answer');?>
			<?php echo form_error('user_answer'); ?>
			<?php echo form_input('user_answer', set_value('user_answer')); ?>
		</div>
		<div class="buttons">
			<?php echo form_submit('submit_ques', 'submit'); ?>
		</div>
		
	<?php echo form_fieldset_close()?>
<?php echo form_close();?>
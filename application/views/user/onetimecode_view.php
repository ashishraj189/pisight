<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div id="main-wrapper">
    <div class="row">
        <div class="col-md-4">                            
        </div>
        <div class="col-md-4">
            <div class="panel panel-white" style="border:none !important;box-shadow: none; ">
                <img class="img-responsive blue-logo" src="<?php echo base_url(); ?>assets/images/blue-logo.png">
                <div class="panel-heading clearfix">                                    
                    <h1>Onetime Code</h1>
                </div>
                <div class="panel-body">
                    <?php if ($this->session->flashdata('message')) : ?>
                        <p><?= $this->session->flashdata('message') ?></p>
                    <?php endif; ?>

                    <?php echo form_open('user/chksecurity/') ?>
                    <div class="form-group" style="margin-top: 30px;">  
                        <?php echo form_error('user_validcode'); ?>
                        
                        <?php 
                        $email_property = array(
                            'type' => 'text',
                            'name' => 'user_validcode',
                            'id' => 'user_validcode',
                            'value' => set_value('user_validcode'),
                            'class' => 'form-control',
                            'placeholder' => 'One Time Password',
                            'required' => 'required'
                        );
                        echo form_error('user_email')
                        ?>
                        <?php echo form_input($email_property) ?>
                        
                    </div>

                    <div class="buttons">
                        <?php echo form_submit('submit_code', 'submit'); ?>
                    </div>

                    <?php echo form_fieldset_close() ?>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>

        <div class="col-md-4">                            
        </div>

    </div><!-- Row -->
</div><!-- Main Wrapper -->
